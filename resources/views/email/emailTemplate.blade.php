<html>
 <body>
<?php //echo public_path();
$full_containt= file_get_contents(public_path() . '/template_builder/html/'.$userId.'/'.$templateName.'.html');
 $repnm=array("{firstname}","{business_name}","{UNSUBSCRIBE}");
 $newfnm=array($firstname,$business_name,$unsubscribe_link);
$new_containt =str_replace($repnm,$newfnm,$full_containt);
echo $new_containt;
//        include public_path() . '/template_builder/html/'.$userId.'/'.$templateName.'.html'; ?>
</body>
</html>