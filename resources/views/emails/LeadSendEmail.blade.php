<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway:wght@500;600&display=swap" rel="stylesheet">
<style type="text/css">
* {
  box-sizing: border-box;
}
@font-face {
    font-family: 'Open Sans', sans-serif;
    font-family: 'Raleway', sans-serif;
}
b{
font-family: 'Open Sans', sans-serif;
}
div {
  font-family: Raleway, sans-serif;
}

/* Style the counter cards */
.card {

  padding: 16px;

}
</style>
</head>
<body >

<div style="width:100%; height: auto; display: block;background-color: #f1f1f1;" >


<div class="card" style="background-color: #fff;">

      <p>Dear {{$details['partnerName']}},</p>

      <p>
        Here is the new requirements for {{$details['leadRequirement']}} from our potential client.
    </p>
    <p>
        Requirements generated from: {{$details['leadAddress']}} <br>
        Initial requirements: {{$details['initialRequirement']}} <br>
    </p>
    <p>
        Malhar Infoway is following the collaboration based business model. Means:
        <ol type="1">
            <li>Malhar Infoway will introduce you as a collaborator to the client.</li>
            <li>You will discuss everything and responsible to execute the project. You will be invoice to client under your brand name.</li>
            <li>You will pay me {{$details['partnerPercent']}}% on each invoice (based on invoice amount and not on the profit) until finish of the project, only if you win the project and after getting paid by client.</li>
            <li>You will only pay me if and when you get paid by client. No other charges.</li>
            <li>This is not just for one project. It is for any upcoming inquiries by me.</li>
        </ol>
    </p>
    <p>
        If you can provide the service based on the initial requirements and agree with the terms click on <a href= "https://admintest.malharinfoway.com/showClientPage?action_id={{md5(base64_encode('yes'))}}&partner_id={{(base64_encode($details['partnerId']))}}&lead_id={{(base64_encode($details['leadId']))}}" target="_blank">YES</a> <br>
        If you do not want to proceed with this requirements but wanted to keep hearing from us for more requirements then click on <a href= "https://admintest.malharinfoway.com/showClientPage?action_id={{md5(base64_encode('no'))}}&partner_id={{(base64_encode($details['partnerId']))}}&lead_id={{(base64_encode($details['leadId']))}}" target="_blank">NO</a> <br>
        If you do not want to hear from us anymore click on <a href= "https://admintest.malharinfoway.com/showClientPage?action_id={{md5(base64_encode('stop'))}}&partner_id={{(base64_encode($details['partnerId']))}}&lead_id={{(base64_encode($details['leadId']))}}" target="_blank">STOP</a>.
    </p>

    <p>
        If you have any questions, please reply this email.
    </p>

      <p>&nbsp;</p>
     	<p style="line-height: 15px;">
        Thanks,<br>Abhishek<br>
        CEO – Malhar Infoway, India <br>
        <a href="http://malharinfoway.com">www.malharinfoway.com</a>
      </p>
    </div>

</div>
</body>
</html>
