<?php
require 'functions.php';
auth();
require 'dbconfig.php';
include 'header.php';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Property Matcher</title>
   <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" style="width:1800px;" align="left">
                <h3 class="text-center">Lettings Applicants</h3>
                <div class="table-responsive" id="lettings_table">
          
  
<a href ="lettings_data.php">Back</a>
<?php
include('simple_html_dom.php');
include 'dbconfig.php';


function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = json_decode($content);
    return $content;
}

$conn = new mysqli($host,$user,$password,$datbase);
if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$sql_query = "SELECT * FROM users WHERE user_id=".$_GET['property_match'];

$result = $conn->query($sql_query);

if($result->num_rows >0){
    while($row =  $result->fetch_assoc()) {
        $root = 'https://www.rightmove.co.uk/property-to-rent/find.html?locationIdentifier=BRANCH%5E62389';
        $root_array = 'https://www.rightmove.co.uk';
        $maxbedrooms = $row['bedrooms'];
        $minbedrooms = $row['bedrooms'];
        $maxPrice = '&maxPrice=' . $row['maximum_budget'];
        $firstname=$row['first_name'];
        $contact_number=$row['contact_number'];
        $email=$row['email'];
        $budget=$row['maximum_budget'];
        $applicantname = '&' . $row['first_name'] . $row['last_name'];
        $replacecommamaxPrice = str_replace(',', '', $maxPrice);
        $replacestudiomax = str_replace('studio', '0', $maxbedrooms);
        $replacestudiomin = str_replace('studio', '0', $minbedrooms);
        $url_attr = '&maxBedrooms=' . $replacestudiomax . '&minBedrooms=' . $replacestudiomin . $replacecommamaxPrice;
        $url = $root . $url_attr;
        file_put_contents('rightmovepage.html', get_web_page($url));
        $html = file_get_html('rightmovepage.html');
        foreach($html->find('span[class=searchHeader-resultCount]')as $result_amount) {
        }

        $date = date("H");
        if ($date < "12:00") {
            $sms="Good Morning ".$firstname.", <br><br> It's Karl from Benson and Partners. 
           
            You have enquired with us looking for a ".$minbedrooms." bedroom property to rent. <br><br> Please consider seeing the following properties.
            <!--<br>
            Let me know on below information by texting back, calling 0208 653 3444 or emailing karl@bensonpartners.co.uk.<br>
            <!--<br>
            What's your availability for viewings?<br>
            How many people is it for?<br>
            Are you working professional(s)?<br>
            What is your overall annual income?<br>
            Do you have children? Do you have any pets?<br>
            Are you planning to rent the property for minimum 1 year?<br>
           -->";
           
            
        } else {
            $sms="Good Afternoon ".$firstname.", <br><br> It's Karl from Benson and Partners.
            
            You have enquired with us looking for a ".$minbedrooms." bedroom property to rent. <br><br> Please consider seeing the following properties.
             <!--<br>
            Let me know on below information by texting back, calling 0208 653 3444 or emailing karl@bensonpartners.co.uk.<br>
            <br>
            What's your availability for viewings?<br>
            How many people is it for?<br>
            Are you working professional(s)?<br>
            What is your overall annual income?<br>
            Do you have children? Do you have any pets?<br>
            Are you planning to rent the property for minimum 1 year?<br>
            -->";
        }

        echo "<br>Found ". $result_amount->innertext . " match(es) "; //found x matches

        echo "<form action='?' method='POST'>";
            for ($i=1;$i<10;$i++) {
                foreach ($html->find('div[id^="property-'.$i.'"]') as $banner) {
    
                    foreach ($banner->find('a[class="propertyCard-img-link aspect-3x2"]') as $item_link) {
                        
                        echo "<br><a target='_blank' href=" . $root_array . $item_link->href . ">$root_array$item_link->href</a>";
                        file_put_contents('rightmovepage.html', get_web_page($root_array.$item_link->href));
                        $html2 = file_get_html('rightmovepage.html');
                        foreach($html2->find('div.property-header-bedroom-and-price ') as $property_info) {
                          echo "<br> <input type='checkbox' name='introduced[] value='$property_info->plaintext'>".$property_info->plaintext."<br>";
                            foreach($property_info->find('a[id!=link-fees]')as $minus_tenancy){
                                echo "<br>".$minus_tenancy."<br>";
                            }
                        }
                    }
                }
            }
           
            if(isset($_POST['introduced_property'])){
                if(!empty($_POST['introduced'])){
                    $property_introduced = '<br>-------------<br> Property introduced: <br>';
                    var_dump($list_of_properties);
                    foreach($_POST['introduced'] as $list){
                        $list.=$_POST['introduced'];
                    }
                    print_r($list);
                    $update_special_conditions = "UPDATE users SET special_conditions = '$list' WHERE user_id=".$_GET['property_match']."";
    
                }
            }
            
            echo "<input type='submit' name='introduced_property' value='Insert'>";
        echo "</form>";
        echo "<br><a target='_blank' href=".$url.">Open in Rightmove</a>";

        file_put_contents('rightmovepage.html', get_web_page($url));
        $html = file_get_html('rightmovepage.html');
        foreach($html->find('span[class=searchHeader-resultCount]')as $result_amount) {
        }
        echo "<br>".$contact_number."<br>";
        echo   $sms."<br>";
        for ($i=1;$i<10;$i++) {
            foreach ($html->find('div[id^="property-'.$i.'"]') as $banner) {

                foreach ($banner->find('a[class="propertyCard-img-link aspect-3x2"]') as $item_link) {
                    echo "<br><a target='_blank' href=" . $root_array . $item_link->href . ">$root_array$item_link->href</a><br>";
                }
            }
        }
    }
}
            echo "<br>Good Afternoon ".$firstname.", <br> It's Karl here again. Have you considered the properties I've sent you today?";
?>

        <?php
        $date=date("H");
        if($date<"12:00"){
            $genericenquiry="Good Morning ".$firstname.", following your property enquiry in regards to the ".$minbedrooms." bedroom property to buy, please see below properties matching your budget of £".$budget;
            $specificenquiry="Good Morning ".$firstname.", thank you for your interest in the property below: please also consider the following properties matching your criteria ";
            $validate="Good Morning ".$firstname.", thank you for your interest for the property below: please also consider the following properties matching your criteria. Would you kindly let me know how many people is the property for and what would be the combined income of all the tenants.";
            $push="Good Morning ".$firstname.", this is a quick message to let you that we have just started marketing the property below, please let me know you're interested";
            $stilllooking="Good Morning ".$firstname.", I hope you're well. It's been a while since we last spoke. Are you still looking for a property to buy? Please let me know. Just to be on the same page, please see the properties matching your criteria, some of them might be reduced since you last saw them";
            $viewingres="Good Monrning ".$firstname.", I hope you're well. As discussed I've booked an appointment to see the property at am/pm today at the following address. See you there.";;
        }else{
            $genericenquiry="Good Afternoon ".$firstname.", following your property enquiry in regards to a ".$minbedrooms." bedroom property to buy, please see below properties matching your budget of £".$budget;
            $specificenquiry="Good Afternoon ".$firstname.", thank you for your interest in the property below: please also consider the following properties matching your criteria";
            $validate="Good Afternoon ".$firstname.", thank you for your interest for the property below: please also consider the following properties matching your criteria. Would you kindly let me know how many people is the property for and what would be the combined income of all the tenants.";
            $push="Good Afternoon ".$firstname.", this is a quick message to let you that we have just started marketing the property below, please let me know you're interested";
            $stilllooking="Good Afternoon ".$firstname.", I hope you're well. It's been a while since we last spoke. Are you still looking for a property to buy? Please let me know. Just to be on the same page, please see the properties matching your criteria, some of them might be reduced since you last saw them";
            $viewingres="Good Afternoon ".$firstname.", I hope you're well. As discussed I've booked an appointment to see the property at am/pm today at the following address. See you there.";
        }?>
        <h1>5E5427</h1>
<pre>
Sunny Bank
https://www.youtube.com/watch?v=_3JELCsKOvY

Selhurst Road
https://www.youtube.com/watch?v=2b7iVZpv4UE
</pre>

       

        <form name="form1">
            <select style="background-color: transparent; font-size: 10px; color: rgb(0, 102, 153); font-family: verdana;" name="menu">
                <option value="#">Templates</option>
                <option value="<?php echo $genericenquiry; ?>">Generic Enquiry</option>
                <option value="<?php echo $specificenquiry; ?>">Specific Enquiry</option>
                <option value="<?php echo $validate; ?>">Validate Applicant</option>
                <option value="<?php echo $push; ?>">New Property Push</option>
                <option value="<?php echo $stilllooking; ?>">Still Looking?</option>
                <option value="<?php echo $viewingres; ?>">Book a viewing</option>
            </select>
            <input
                    style="font-size: 8pt; color: rgb(255, 255, 255); font-family: verdana; background-color: rgb(0, 102, 153);"
                    value="Choose" type="button" onClick="document.form1.accept.value=document.form1.menu.options[document.form1.menu.selectedIndex].value;document.form1.textareaaccept.value=document.form1.menu.options[document.form1.menu.selectedIndex].value;">
            <br/>
            <br/>

            <input type="text" name="accept" style="width:200px;">
            <br/>
            <textarea rows='20' cols='40' name="textareaaccept" style="width:800px;height:400px;"></textarea>
        </form>



        <?php
        $date=date("H");
        if($date<"12:00"){
            $body="Good%20Morning%20".$firstname.",%0A%0Afollowing%20your%20property%20enquiry%20in%20regards%20to%20a%20".$row['bedrooms']."%20bedroom%20property%20for%20sale,%20please%20see%20below%20properties%20matching%20your%20criteria.";
            $subject="Property%20Enquiry%20-%20Benson%20and%20Partners";
        }else{
            $body="Good%20Afternoon%20".$firstname.",%0A%0Afollowing%20your%20property%20enquiry%20in%20regards%20to%20a%20".$row['bedrooms']."%20bedroom%20property%20for%20sale,%20please%20see%20below%20properties%20matching%20your%20criteria.";
            $subject="Property%20Enquiry%20-%20Benson%20and%20Partners";
        }?>
        <br>
        <?php
      
        if($date<"12:00"){
            $body="Good%20Morning%20".$firstname.",%0A%0Amany%20thanks%20for%20choosing%20Benson%20and%20Partners.%0APlease%20find%20the%20details%20of%20".$row['bedrooms']."%20bedroom%20property%20to%20rent%20below: %0A";
            $subject="Property%20Enquiry%20-%20Benson%20and%20Partners";
        }else{
            $body="Good%20Afternoon%20".$firstname.",%0A%0Amany%20thanks%20for%20choosing%20Benson%20and%20Partners.%0APlease%20find%20the%20details%20of%20".$row['bedrooms']."%20bedroom%20property%20to%20rent%20below: %0A";
            $subject="Property%20Enquiry%20-%20Benson%20and%20Partners";
        }?>
        <a href="mailto:<?php echo $email;?>?subject=<?php echo $subject ?>&body=<?php echo $body;?>">Email</a>

</body>
</html>