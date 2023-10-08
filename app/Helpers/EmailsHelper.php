<?php


use Illuminate\Support\Facades\App;

function send_email_with_code($user, $type, $transKey)
{
    $lang=$user->lang();
    App::setLocale($lang);
    $subject=__('email.'.$transKey);
    $email=$user->email;
    $data=[];
    $data['code']=1;
    $data['language']=$lang;
    $name=$user->name;

    Mail::send('emails.send_email_with_code', $data, function ($mail) use ($email,$name, $subject) {
        $mail->to($email, $name);
        $mail->subject($subject);
    });

    return 1;
}

/**
 * @param $emails
 * @param $title
 * @param $content
 * @return mixed
 */
function send_emails($emails,$title,$content)
{
    $subject=$title;
    $data=[];
    $data['content']=$content;
    Mail::send('emails.send_email',$data, function ($mail) use ($emails, $subject) {
        $mail->bcc($emails);
        $mail->subject($subject);
    });

   return Mail:: failures();
    //exit;
}
