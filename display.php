<?php
if(isset($_POST['register']))
{
	$xml = new DomDocument("1.0", "UTF-8");
	$xml->preserveWhiteSpace = false;
	$xml->formatOutput=true;
	$xml->load('Tutors.xml');

	$days=['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

	
	$fullname = $_POST['firstname']." ".$_POST['lastname'];
	
	echo "<h3>my name is " . $fullname ."</h3>";
	
	$email = $_POST['email'];
	
	echo "<h2>Your email address is: " . $email . "</h2>";
	
	$subjects = $_POST['subject'];
	
	echo "<h2>The subjects I teach are as follows:</h2>";
	
	

	
	$tutorsTag = $xml->getElementsByTagName("Tutors")->item(0);
	
	$tutor = $xml->createElement("tutor");
	$tutor->setAttribute("qanda","true");
	$tutor->setAttribute("workshop","true");
	$tutor->setAttribute("bookclub","true");

	
	$tutorsTag->appendChild($tutor);
	$name=$xml->createElement("name", $fullname);
	$tutor->appendChild($name);
	$emailTag = $xml->createElement("email", $email);
	$tutor->appendChild($emailTag);
	$teachingTag=$xml->createElement("teaching");
	$tutor->appendChild($teachingTag);
	
	foreach($subjects as &$subject)
	{
		$subjectTag=$xml->createElement("subject", $subject);
		$teachingTag->appendChild($subjectTag);
	}
	
	$availabilityTag = $xml->createElement("available");
	$tutor->appendChild($availabilityTag);
	
	foreach($days as &$day)
	{
		echo "<h3>".$day."</h3>";
		if(isset($_POST[$day]))
		{
			$dayTag=$xml->createElement("day", $day);
			$availabilityTag->appendChild($dayTag);
			
			foreach($_POST[$day] as &$time)
			{
				$timeTag=$xml->createElement("time", $time);
				$dayTag->appendChild($timeTag);
			}
		}
	}
	
	$xml->save('Tutors.xml');
}
?>