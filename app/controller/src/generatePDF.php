<?php

require ROOT .'/public/fpdf/fpdf.php';
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';
protected $requestData;
function Header()
{
    global $title;



    // For header 
    
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);

    // $this->Image('logo.png', 10, 10, -300);
    // Insert a dynamic image from a URL
    $this->Image(ROOT .'/public/img/header.png', 0, 1, 210, 0, 'PNG');
    // Colors of frame, background and text
    // $this->SetDrawColor(0,80,180);
    // $this->SetFillColor(230,230,0);
    // $this->SetTextColor(220,50,50);
    // // Thickness of frame (1 mm)
    // $this->SetLineWidth(3);
    // // Title
    // $this->Cell($w,9,$title,1,1,'C',true);
    // Line break
    $this->Ln(30);
}


function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function ChapterTitle($num, $label)
{
    // Arial 12
    $this->SetFont('Arial','',12);
    // Background color
    $this->SetFillColor(200,220,255);
    // Title
    $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
    // Line break
    $this->Ln(4);
}


    function RequestForm()
    {

        // var_dump($this->requestData);
        // exit();
        $this->AddPage();

        //For Title
        $this->SetTitle('PUBLIC INFORMATION SERVICES REQUEST FORM');
        $this->SetFont('Arial','B',10);
        $this->Cell(50);
        // $this->Cell(30,10,'PUBLIC INFORMATION SERVICES REQUEST FORM',0, 1,'C');
        $this->WriteHTML('<b><u>PUBLIC INFORMATION SERVICES REQUEST FORM</u></b><br>');


        $this->SetFont('Arial','',10);
        $this->Cell(60,10,'Request Number (for PIO Personnel):',0,0,'L');
        $this->SetFont('Arial','BU',10);
        $this->Cell(30,10,$this->requestData[0]['r_request_code'],0,1);

        // For Form
        $this->SetFont('Arial','b',10);
        $this->Cell(80);
        $this->Cell(30,10,'ACTIVITY INFORMATION',0, 1,'C');
        $this->SetFont('Arial','',9);
        $this->Cell(30,5,'Name of the Activity:',0, 0,'L');

        $this->SetFont('Arial','U',9);
        $this->WriteHTML('<b><u>'.$this->requestData[0]['r_activityname'].'</u></b><br>');
        
        // $this->Cell(80);
        // $this->Cell(30,10,'ACTIVITY INFORMATION',0,1,'C');
        // $this->SetFont('Arial','',9);
        // $this->Cell(50,5,'Name of the Activity:',0,0,'L');
        
        // //draw the full underline
        // $this->Cell(100,0,'',0,1,'L');
        // $this->Cell(30); // Indent to align with the underline
        // $this->Cell(100,5,str_repeat('_', 50),0,0,'L');

        // //overlay the activity name (without underline)
        // $this->SetFont('Arial','',9); 
        // $this->SetXY($this->GetX() - 100, $this->GetY());
        // $this->Cell(100,5,$this->requestData[0]['r_activityname'],0,1,'C');

        
        $this->SetFont('Arial','',9);

   
        // $this->Cell(23,5,'Date and Time:',0, 0,'L');
        // if($this->requestData[0]['t_dateRequested'] != ''){
        //     // $this->WriteHTML('<b><u>'.$this->requestData[0]['t_dateRequested'].'</u></b><br>');
        //     $this->SetFont('Arial','U',9);
        //     $this->Cell(50,5,$this->requestData[0]['t_dateRequested'],0, 0,'L');
        // }else{
        //     // $this->Cell(51,5,'_________________________',0, 0,);
        //     $this->Cell(50,5,'_________________________',0, 0,'L');
        // }
        // $this->Cell(23,5,'Date and Time:',0, 0,'L');
        // if($this->requestData[0]['r_durationStart'] != ''){
        //     $formattedDate = date('F j, Y, g:i A', $this->requestData[0]['r_durationStart']); 
        //     $this->SetFont('Arial','U',9);
        //     $this->Cell(50,5,$formattedDate,0, 0,'L');
        // } else {
        //     $this->Cell(50,5,'_________________________',0, 0,'L');
        // }
        $this->Cell(23,5,'Date and Time:',0, 0,'L');

        if (!empty($this->requestData[0]['r_durationStart']) && !empty($this->requestData[0]['r_durationEnd'])) {
            $formattedStart = date('F j, Y, h:i A', $this->requestData[0]['r_durationStart']); 
            $formattedEnd = date('F j, Y, h:i A', $this->requestData[0]['r_durationEnd']); 

            $this->SetFont('Arial', 'BU', 9);
            $this->Cell(42.5, 5, $formattedStart, 0, 0, 'L'); 

            $this->SetFont('Arial', 'BU', 9);
            $this->Cell(3, 5, " - ", 0, 0, 'L'); 

            $this->SetFont('Arial', 'BU', 9);
            $this->Cell(50, 5, $formattedEnd, 0, 0, 'L');
        } else {
            $this->Cell(50, 5, '_________________________', 0, 0, 'L');
        }


        // $this->WriteHTML('<b><u>Panabo City, West Philippine Seas</u>  ');
        //
        $this->SetFont('Arial','',9);
        $this->Cell(5);
        $this->Cell(13.5,5,'Venue/s:',0, 0,'L');
        if($this->requestData[0]['r_venue'] != ''){
            // $this->WriteHTML('<b><u>'.$this->requestData[0]['r_venue'].'</u></b><br>');
            $this->SetFont('Arial','U',9);
            $this->WriteHTML('<b><u>'.$this->requestData[0]['r_venue'].'</u></b><br>');
        
        }else{
            // $this->Cell(45,5,'____________________________________________',0, 1,);
            $this->Cell(50,5,'_________________________',0, 0,'L');
        }
        // $this->WriteHTML('<b><u>Panabo City, West Philippine Seas<br>');
        //
        $this->SetFont('Arial','',9);
        $this->Cell(19.5,5,'Participant/s:',0, 0,'L');
        if($this->requestData[0]['r_venue'] != ''){
            $this->WriteHTML('<b><u>'.$this->requestData[0]['r_participants'].'</u></b><br>');
        }else{
            $this->Cell(51,5,'_______________________________________________________________________________',0, 1,);
        
        }
        //
        $this->Cell(54,5,'Resource Speaker/s or Key Official/s:',0, 0,'L');
        if($this->requestData[0]['r_keyofficials'] != ''){
            $this->WriteHTML('<b><u>'.$this->requestData[0]['r_keyofficials'].'</u></b><br>');
        }else{
            $this->Cell(51,5,'____________________________________________________________',0, 1,);
        }

        //
        $this->Cell(37,5,'Highlight/s (if applicable):',0, 0,'L');
        if($this->requestData[0]['r_highlights'] != ''){
            $this->WriteHTML('<b><u>'.$this->requestData[0]['r_highlights'].'</u></b><br>');
        }else{
            $this->Cell(51,5,'______________________________________________________________________',0, 1,);
        }
        //
        $this->Cell(88,5,'Link to photos or other supplementary materials (if available):',0, 0,'L');
        if($this->requestData[0]['r_additionalInfo'] != ""){
            $this->WriteHTML('<b><u>'.$this->requestData[0]['r_additionalInfo'].'</u></b><br>');
        }else{
            $this->Ln(1.5);
            $this->Cell(88);
            //get current X and Y position
            $x = $this->GetX();
            $y = $this->GetY();

            //draw a thin underline
            $this->Line($x, $y + 2, $x + 80, $y + 2);
        }
       

        $this->Cell(80,4,'',0,1);
        $this->WriteHTML('Note: The requester can attach the <b>activity design</b> and <b>the program flow </b> to this request form to help the documenter and writer produce a more comprehensive and compelling article.<br>');
        

        $services = json_decode($this->requestData[0]['r_services']);
        $platforms = json_decode($this->requestData[0]['r_platforms']);
    
        // var_dump($platforms);
        // exit();
        //For checkbox
        $this->SetFont('Arial','B',9);
        $this->Cell(80,5,'',0,1);
        $this->Cell(80);
        $this->Cell(30,7,'SERVICE/S REQUESTED',0, 1,'C');

        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        if (in_array("On-site Documentation", $services)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(51,5,'On-Site Documentation',0, 1,);
        $this->Cell(5);
        $this->Cell(5,5,'',0, 0,'L');
        $this->Cell(5);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(Deliverables: Attendance at the Event, Edited Photos, Website, and Social Media Content) ',0, 1,);
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("Article Drafting", $services)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(51,5,'Article Drafting',0, 1,);
        $this->Cell(5);
        $this->Cell(5,5,'',0, 0,'L');
        $this->Cell(5);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(Deliverables: Website and Social Media Content)',0, 1,);
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("Graphics and Content Design", $services)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(51,5,'Graphics and Content Design',0, 1,);
        $this->Cell(5);
        $this->Cell(5,5,'',0, 0,'L');
        $this->Cell(5);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(Deliverables: Layout of Design and Content for Tarpaulins, Social Media Announcements, Infographics, Report Cover, etc.)',0, 1,);
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("Content Updating on the College Website", $services)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(51,5,'Content Updating on the College Website',0, 1,);
        $this->Cell(5);
        $this->Cell(5,5,'',0, 0,'L');
        $this->Cell(5);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(Deliverables: Updating of Information, Text, Photo, Poster, or Feature on the Website) ',0, 1,);


        //For checkbox (PLATFORMS)      
        $this->SetFont('Arial','B',9);
        $this->Cell(80,5,'',0,1);
        $this->Cell(80);
        $this->Cell(30,7,'PREFERRED PLATFORM/S',0, 1,'C');

        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("College Website: dnsc.edu.ph", $platforms)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(46,5,'College Website: dnsc.edu.ph',0, 0,);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(recommended for articles and banners)',0, 1,);
        $this->Cell(5,1,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("Facebook: @officialDNSC", $platforms)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(40,5,'Facebook: @officialDNSC',0, 0,);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(recommended for announcements, posters, invitations,advisories',0, 1,);
        $this->Cell(15);
        $this->Cell(51,5,'short videos, article links, photo album, live streaming)',0, 1,);
        $this->Cell(5,3,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("Instagram: @officialDNSC", $platforms)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(40,5,'Instagram: @officialDNSC',0, 0,);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(recommended for announcements and photos)',0, 1,);
        $this->Cell(5,3,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("Twitter: @officialDNSC", $platforms)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(35,5,'Twitter: @officialDNSC',0, 0,);
        $this->SetFont('Arial','',9);
        $this->Cell(40,5,'(recommended for announcements, posters, invitations, advisories, short videos,',0, 1,);
        $this->Cell(15);
        $this->Cell(51,5,'article links, few photos)',0, 1,);
        $this->Cell(5,3,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("Youtube: @officialDNSC", $platforms)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(37.5,5,'Youtube: @officialDNSC',0, 0,);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(recommended for videos and live streaming)',0, 1,);
        $this->Cell(5,1,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("Email Blasting: pio@dnsc.edu.ph", $platforms)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(51,5,'Email Blasting: pio@dnsc.edu.ph',0, 0,);
        $this->SetFont('Arial','',9);
        $this->Cell(40,5,'(recommended for targeted information dissemination to a specific',0, 1,);
        $this->Cell(15);
        $this->Cell(51,5,'directory',0, 1,);
        $this->Cell(5,3,'',0, 1,'L');
        //
        $this->Cell(15);
        $this->Cell(54,5,'Target Directory (e.g. all employees):',0, 0,'L');
        if($this->requestData[0]['r_venue'] != ''){
            $this->WriteHTML('<b><u>'.$this->requestData[0]['r_participants'].'</u></b><br>');
        }else{
            $this->Cell(51,5,'_______________________________________________________________________________',0, 1,);
        
        }
        //
        $this->SetFont('Arial','B',9);
        $this->Cell(5);
        if (in_array("College Entryway LED Board", $platforms)) { 
            $this->Cell(5,5,'/',1, 0,'L');
        } else { 
            $this->Cell(5,5,'',1, 0,'L');
        } 
        $this->Cell(5);
        $this->Cell(44.5,5,'College Entryway LED Board',0, 0,);
        $this->SetFont('Arial','',9);
        $this->Cell(51,5,'(recommended for memoranda, announcements, and congratulatory posters)',0, 1,);
        $this->Cell(5,1,'',0, 1,'L');
        //

        $this->Ln(5);
        $this->Cell(30,9,'Requested by:',0, 1,'L');
        $this->Ln(2);
        $this->Cell(25);
        $this->Cell(30,0, $this->requestData[0]['user_fn'] ." ".$this->requestData[0]['user_ln'],0, 1,'L');
        
        //line
        //get current X and Y position
        $x = $this->GetX();
        $y = $this->GetY();

        //draw a thin underline
        $this->Line($x, $y + 2, $x + 80, $y + 2);
        //move to the next line
        $this->Ln(3);
        
        $this->Cell(30,2.5,'Signature Above Printed Name and Designation:',0, 1,'L');
        $this->Ln(1);
        $this->Cell(9,9,'Date: ',0,0,'L');

        //underlined date
        $this->SetFont('Arial','U',9);
        $this->Cell(30,9,$this->requestData[0]['t_dateRequested'],0,1,'L'); 
        $this->SetFont('Arial','',9); 

        $this->Image(ROOT .'/public/img/footer.png', 0, 270, 240, 0, 'PNG');
    }
    function setData($data){
        $this->requestData = $data;
    }
}


?>