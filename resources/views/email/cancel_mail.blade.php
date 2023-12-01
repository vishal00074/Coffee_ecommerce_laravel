<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Email</title>
   </head>
   <body>
        <p><br>{{ $getorders->body }}</p>
        <p><h3><u>User Information</u> :</h3></p>
        
        <table>
                <tr style="padding-left: 10px;">Name &nbsp;&nbsp;&nbsp;&nbsp;{{ $getorders->name }}</tr>
                <tr style="padding-left: 10px;">Email &nbsp;&nbsp;&nbsp;&nbsp;{{ $getorders->email }}</tr>
                <tr style="padding-left: 10px;">Order ID &nbsp;&nbsp;&nbsp;&nbsp;{{ $getorders->order_id }}</tr>
                <tr style="padding-left: 10px;">Product &nbsp;&nbsp;&nbsp;&nbsp;{{ $getorders->product_name }}</tr>
                <tr style="padding-left: 10px;">Amount &nbsp;&nbsp;&nbsp;&nbsp;{{ $getorders->total }}</tr>
           
        </table>
        <br><br>
        
        <div>
            <p>Best regards,</p>
		    <p>The CBD Coffee Team</p>
        </div>
   </body>
</html>