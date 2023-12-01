<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Email</title>
   </head>
   <body>
        <p><br>{{ $detail['body'] }}</p>
        <p><h3><u>User Information</u> :</h3></p>
        
        <table>
                <tr style="padding-left: 10px;">Name &nbsp;&nbsp;&nbsp;&nbsp;{{ $detail['name'] }}</tr>
                <tr style="padding-left: 10px;">Email &nbsp;&nbsp;&nbsp;&nbsp;{{ $detail['email'] }}</tr>
                <tr style="padding-left: 10px;">Subject &nbsp;&nbsp;&nbsp;&nbsp;{{ $detail['subject'] }}</tr>
                <tr style="padding-left: 10px;">Message &nbsp;&nbsp;&nbsp;&nbsp;{{ $detail['message'] }}</tr>
           
        </table>
        <br><br>
        
        <div>
            <p>Best regards,</p>
		    <p>The CBD Coffee Team</p>
        </div>
   </body>
</html>