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
    // Colors of frame, background and text
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(3);
    // Title
    $this->Cell($w,9,$title,1,1,'C',true);
    // Line break
    $this->Ln(5);
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
        $this->AddPage();

        //For Title
        $this->SetTitle('PUBLIC INFORMATION SERVICES REQUEST FORM');
        $this->SetFont('Arial','B',10);
        $this->Cell(50);
        // $this->Cell(30,10,'PUBLIC INFORMATION SERVICES REQUEST FORM',0, 1,'C');
        $this->WriteHTML('<b><u>PUBLIC INFORMATION SERVICES REQUEST FORM</u></b><br>');


        $this->SetFont('Arial','',10);
        $this->Cell(60,10,'Request Number (for PIO Personnel):',0,0,'L');
        $this->SetFont('Arial','b',10);
        $this->Cell(30,10,'sss',0,1);

        // For Form
        $this->Cell(80);
        $this->Cell(30,10,'ACTIVITY INFORMATION',0, 1,'C');
        $this->SetFont('Arial','',10);
        $this->Cell(35,5,'Name of the Activity:',0, 0,'L');

        $this->SetFont('Arial','U',10);
        $this->WriteHTML('<b><u>Invitation to BID: LEASE OF AVAILABLE COMMERCIAL SPACES AT SCIENCE BUILDING (DNSC-ITB No. 2024-05-09) and for the MAINTENANCE, HARVESTING AND BUYING OF MANGGOES (DNSC-ITB No. 2024-05-010)</u></b><br>');
        
        $this->SetFont('Arial','',10);

   
        $this->Cell(25,5,'Date and Time:',0, 0,'L');

        if()
        $this->Cell(51,5,'_________________________',0, 0,);
        // $this->WriteHTML('<b><u>Panabo City, West Philippine Seas</u>  ');

   
        $this->Cell(15,5,'Venue/s:',0, 0,'L');
        $this->Cell(45,5,'____________________________________________',0, 1,);
        // $this->WriteHTML('<b><u>Panabo City, West Philippine Seas<br>');

   
        $this->Cell(22,5,'Participant/s:',0, 0,'L');
        $this->Cell(51,5,'_______________________________________________________________________________',0, 1,);
        
        $this->Cell(60,5,'Resource Speaker/s or Key Official/s:',0, 0,'L');
        $this->Cell(51,5,'____________________________________________________________',0, 1,);

        $this->Cell(40,5,'Highlight/s (if applicable):',0, 0,'L');
        $this->Cell(51,5,'______________________________________________________________________',0, 1,);

        $this->Cell(78,5,'Link to photos or other supplementary materials:',0, 0,'L');
        $this->Cell(51,5,'___________________________________________________',0, 1,);

        $this->Cell(80,5,'',0,1);
        $this->WriteHTML('Note: The requester can attach the <b>activity design</b> and <b>the program flow </b> to this request form to help the documenter and writer produce a more comprehensive and compelling article.<br>');
        
        //For checkbox
        $this->SetFont('Arial','B',10);
        $this->Cell(80,5,'',0,1);
        $this->Cell(80);
        $this->Cell(30,10,'SERVICE/S REQUESTED',0, 1,'C');

        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(51,5,'On-Site Documentation',0, 1,);
        $this->Cell(5);
        $this->Cell(5,5,'',0, 0,'L');
        $this->Cell(5);
        $this->SetFont('Arial','',10);
        $this->Cell(51,5,'(Deliverables: Attendance at the Event, Edited Photos, Website, and Social Media Content) ',0, 1,);
        //
        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(51,5,'Article Drafting/ Reviewing',0, 1,);
        $this->Cell(5);
        $this->Cell(5,5,'',0, 0,'L');
        $this->Cell(5);
        $this->SetFont('Arial','',10);
        $this->Cell(51,5,'(Deliverables: Website and Social Media Content)',0, 1,);
        //
        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(51,5,'Graphics and Content Design',0, 1,);
        $this->Cell(5);
        $this->Cell(5,5,'',0, 0,'L');
        $this->Cell(5);
        $this->SetFont('Arial','',10);
        $this->Cell(51,5,'(Deliverables: Layout of Design and Content for Tarpaulins, Social Media Announcements, Infographics, Report Cover, etc.)',0, 1,);
        //
        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(51,5,'Content Updating on the College Website',0, 1,);
        $this->Cell(5);
        $this->Cell(5,5,'',0, 0,'L');
        $this->Cell(5);
        $this->SetFont('Arial','',10);
        $this->Cell(51,5,'(Deliverables: Updating of Information, Text, Photo, Poster, or Feature on the Website) ',0, 1,);


        //For checkbox (PLATFORMS)      
        $this->SetFont('Arial','B',10);
        $this->Cell(80,5,'',0,1);
        $this->Cell(80);
        $this->Cell(30,10,'PREFERRED PLATFORM/S',0, 1,'C');

        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(52,5,'College Website: dnsc.edu.ph',0, 0,);
        $this->SetFont('Arial','',10);
        $this->Cell(51,5,'(recommended for articles and banners)',0, 1,);
        $this->Cell(5,1,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(55,5,'Facebook: @officialDNSC',0, 0,);
        $this->SetFont('Arial','',10);
        $this->Cell(51,5,'(recommended for announcements, posters, invitations,advisories',0, 1,);
        $this->Cell(15);
        $this->Cell(51,5,'short videos, article links, photo album, live streaming)',0, 1,);
        $this->Cell(5,3,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(38,5,'Twitter: @officialDNSC',0, 0,);
        $this->SetFont('Arial','',10);
        $this->Cell(40,5,'(recommended for announcements, posters, invitations, advisories, short videos,',0, 1,);
        $this->Cell(15);
        $this->Cell(51,5,'article links, few photos)',0, 1,);
        $this->Cell(5,3,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(68,5,'YouTube: @officialDNSC',0, 0,);
        $this->SetFont('Arial','',10);
        $this->Cell(51,5,'(recommended for videos and live streaming)',0, 1,);
        $this->Cell(5,1,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(57,5,'Email Blasting: pio@dnsc.edu.ph',0, 0,);
        $this->SetFont('Arial','',10);
        $this->Cell(40,5,'(recommended for targeted information dissemination to a specific',0, 1,);
        $this->Cell(15);
        $this->Cell(51,5,'directory',0, 1,);
        $this->Cell(5,3,'',0, 1,'L');
        //
        $this->SetFont('Arial','B',10);
        $this->Cell(5);
        $this->Cell(5,5,'',1, 0,'L');
        $this->Cell(5);
        $this->Cell(62,5,'College Entryway LED Board',0, 0,);
        $this->SetFont('Arial','',10);
        $this->Cell(51,5,'(recommended for memoranda and announcements)',0, 1,);
        $this->Cell(5,1,'',0, 1,'L');
        //

        $this->Ln(2);
        $this->Cell(30,10,'Requested by:',0, 1,'L');
        $this->Ln(1);
        $this->Cell(30,10,'_____________________',0, 1,'L');
        $this->Cell(30,0,'Signature Above Printed Name and Designation:',0, 1,'L');
        $this->Ln(5);
        $this->Cell(30,10,'Date: May 20, 2024',0, 1,'L');
    }

    function setData($data){
        $this->requestData = $data;
    }
}

?>