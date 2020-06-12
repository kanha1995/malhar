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

    <p>Hi {{$details['partnerName']}},</p>
    <p>
    Greetings.
    </p>
    <p>
        I am Abhishek Soni from India. I am owning Malhar Infoway. Malhar Infoway is in the consultancy and collaboration business. We are helping our customers to connect with local service providers. {{$details['partnerBody']}}
    </p>

    <p>
        My client at {{$details['partnerLocation']}} is looking for {{$details['partnerService']}}. Can you help us with the same?
    </p>

    <p>
        I am following the collaboration based business model. Means:
        <ol type="1">
            <li>I will share the client contact details with you and introduce you as a collaborator.</li>
            <li>You will discuss everything and responsible to execute the project. You will be invoice to client under your brand name.</li>
            <li>You will pay me {{$details['partnerPercent']}}% on each invoice (based on invoice amount and not on the profit) until finish of the project, only if you win the project and after getting paid by client.</li>
            <li>You will only pay me if and when you get paid by client. No other charges.</li>
            <li>This is not just for one project. It is for any upcoming inquiries by me.</li>
        </ol>

	Please let me know if you are agree, so that I can connect you with my client.
    </p>

      <p>&nbsp;</p>
      <p style="line-height: 15px;">
		<p style="font-size: 15px;">Thanks,<br>Abhishek</p>
      </p>
    </div>
    
</div>
</body>
</html>
