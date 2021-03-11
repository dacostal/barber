<?php

namespace App\EventSubscriber;

use App\Repository\AppointmentRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $appointmentRepository;
    private $router;

    public function __construct(
        AppointmentRepository $appointmentRepository,
        UrlGeneratorInterface $router
    ) {
        $this->appointmentRepository = $appointmentRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();
        $filters['property-index'];

        // Modify the query to fit to your entity and needs
        // Change appointment.beginAt by your start date property
        $appointments = $this->appointmentRepository
            ->createQueryBuilder('appointment')
            ->where('appointment.startTime BETWEEN :start and :end OR appointment.endTime BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($appointments as $appointment) {
            // this create the events with your data (here appointment data) to fill calendar
            $appointmentEvent = new Event(
                $appointment->getService(),
                $appointment->getStartTime()->format('Y-m-d H:i:s'),
                $appointment->getEndTime()->format('Y-m-d H:i:s') // If the end date is null or not defined, a all day event is created.
            );


            $appointmentEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
            $appointmentEvent->addOption(
                'url',
                $this->router->generate('appointment_show', [
                    'id' => $appointment->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($appointmentEvent);
        }
    }
}