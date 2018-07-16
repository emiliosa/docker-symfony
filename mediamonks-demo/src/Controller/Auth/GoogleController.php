<?php

namespace App\Controller\Auth;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/connect/google")
 */
class GoogleController extends Controller
{
    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("", name="connect_google")
     */
    public function connectAction()
    {
        return $this->get('knpu.oauth2.registry')
            ->getClient('google') // key used in config.yml
            ->redirect();
    }

    /**
     * After going to google, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config.yml
     *
     * @Route("/check", name="connect_google_check")
     */
    public function connectCheckAction(Request $request)
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
        // (read below)

        /*$client = $this->get('knpu.oauth2.registry')->getClient('google');

        try {
            // the exact class depends on which provider you're using
            $user = $client->fetchUser();

            // do something with all this new power!
            $user->getFirstName();
            // ...
        } catch (IdentityProviderException $e) {
            // something went wrong!
            // probably you should return the reason to the user
            throw $e;
        }*/

        //return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
    }
}
