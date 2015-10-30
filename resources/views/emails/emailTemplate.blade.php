<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width"/>

        <!-- For development, pass document through inliner -->



    </head>
    <body>
        @if($msgBody != '')
            {!! $msgBody !!}
            @else
        <table style="width: 100% !important; height: 100%; background: #efefef; -webkit-font-smoothing:antialiased; -webkit-text-size-adjust: none;font-size: 100%;
               font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
               line-height: 1.65; ">
            <tr>
                <td style="display: block !important;clear: both !important; margin: 0 auto !important;
                    max-width: 580px !important;">

                    <!-- Message start -->
                    <table style="width: 100% !important; border-collapse: collapse;">
                        <tr>
                            <td align="center" style="padding: 80px 0;background: #71bc37;color: white;">

                                <h1 style="margin: 0 auto !important;max-width: 90%;text-transform: uppercase; ">Something Big...</h1>

                            </td>
                        </tr>
                        <tr>
                            <td style=" background: white;padding: 30px 35px;">

                                <h2 style="font-size: 28px;">Hi Stranger,</h2>

                                <p style="font-size: 16px;font-weight: normal;margin-bottom: 20px;">Kielbasa venison ball tip shankle. Boudin prosciutto landjaeger, pancetta jowl turkey tri-tip porchetta beef pork loin drumstick. Frankfurter short ribs kevin pig ribeye drumstick bacon kielbasa. Pork loin brisket biltong, pork belly filet mignon ribeye pig ground round porchetta turducken turkey. Pork belly beef ribs sausage ham hock, ham doner frankfurter pork chop tail meatball beef pig meatloaf short ribs shoulder. Filet mignon ham hock kielbasa beef ribs shank. Venison swine beef ribs sausage pastrami shoulder.</p>

                                <table style="width: 100% !important; border-collapse: collapse;">
                                    <tr>
                                        <td align="center">
                                            <p style="font-size: 16px;font-weight: normal;margin-bottom: 20px;">
                                                <a href="#" style="display: inline-block;color: white;
                                                   background: #71bc37;
                                                   border: solid #71bc37;
                                                   border-width: 10px 20px 8px;
                                                   font-weight: bold;
                                                   border-radius: 4px; 
                                                   text-decoration:none;
                                                   ">
                                                    Share the Awesomeness
                                                </a>
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <p style="font-size: 16px;font-weight: normal;margin-bottom: 20px;">By the way, if you're wondering where you can find more of this fine meaty filler, visit <a href="#" style="color: #71bc37; text-decoration: none; ">Bacon Ipsum</a>.</p>

                                <p><em>Mr John</em>
                                </p>

                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td style=" display: block !important;clear: both !important;margin: 0 auto                         !important; max-width: 580px !important;">

                    <!-- Message start -->
                    <table  style="width: 100% !important; border-collapse: collapse";>
                        <tr>
                            <td style="background: none;" align="center">
                                <p style="margin-bottom: 0;color: #888;text-align: center;
                                   font-size: 14px;">
                                    Sent by 
                                    <a href="#" style=" color: #888;text-decoration: none;
                                       font-weight: bold;">Company Name</a>, 1234 Yellow Brick Road, OZ, 99999</p>    
                                <p><a href="mailto:" style=" color: #888;text-decoration: none;
                                      font-weight: bold;">hello@company.com</a> | <a href="#" style="color: #888;font-weight: bold;text-decoration: none;">Unsubscribe</a>
                                </p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
            @endif
    </body>
</html>
