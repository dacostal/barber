<?php

namespace App\Service;

use App\Entity\Customer;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class SendingMail
{
    /**
     * @param Environment $twig
     * @param Swift_Mailer $mailer
     * @param Customer $customer
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function sendMail(Environment $twig, Swift_Mailer $mailer, Customer $customer): void
    {
        $message = (new Swift_Message('Bienvenue chez Chewbacca Barber Shop'))
            ->setFrom(['dacostalpro@gmail.com' => 'Chewbacca Barber Shop'])
            ->setTo($customer->getEmail())
            ->setBody(
                $twig->render(
                    'templates/emails/welcome.html.twig',
                    ['name' => $customer->getFirstName()]
                )
            )
        ;

        $mailer->send($message);
    }
}
