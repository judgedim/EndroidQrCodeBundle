<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\QrCodeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Endroid\QrCode\QrCode;

/**
 * QR code controller.
 */
class QrCodeController extends Controller
{
    /**
     *
     * @Route("/{text}.{extension}", name="endroid_qrcode", requirements={"text"="[\w\W]+", "extension"="jpg|png|gif"})
     *
     */
    public function generateAction($text, $extension)
    {
        $qrCode = new QrCode();
        $qrCode->setText(urldecode($text));
        $qrCode = $qrCode->get($extension);

        $mime_type = 'image/'.$extension;
        if ($extension == 'jpg') {
            $mime_type = 'image/jpeg';
        }

        return new Response($qrCode, 200, array('Content-Type' => $mime_type));
    }
}
