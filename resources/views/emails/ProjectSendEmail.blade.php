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
      <p>Dear {{$details['leadName']}},</p>
      <p>Greetings.</p>
      <p>
        I am Abhishek Soni. We are discussing about {{$details['leadRequirement']}}.
      </p>
      <p>
        Introducing {{$details['partnerName']}}. {{$details['partnerName']}} is located at {{$details['partnerAddress']}} and he can help you in {{$details['leadRequirement']}}.
      </p>

      <p>
        Dear {{$details['partnerName']}}, please help to introduce yourself and help to send your portfolio, company profile or CV.
      </p>


      <p>&nbsp;</p>
      <p style="line-height: 15px;">
        Thanks,<br>Abhishek<br>
        CEO – Malhar Infoway, India <br>
        <a href="http://malharinfoway.com/">www.malharinfoway.com</a>
      </p>
    </div>

</div>
</body>
</html>
