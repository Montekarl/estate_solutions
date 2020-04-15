<html>
<body>

<form action="reservation_deposit_form_handler.php" method="post">

Full Name:<br>
<input type="text" name="name"><br>

Contact Number:<br>
<input type="text" name="number"><br>

E-mail: <br>
<input type="text" name="email"><br>

Full Property Address:<br>
<input type="text" name="full_address"><br>

Postcode:<br>
<input type="text" name="postcode"><br>

Move in Date: <br>
<input type="date" name="move_in_date"><br>

Offer :<br>
<input type="text" name="offer_in_numbers"><br>

Payment Reference:<br>
<input type="text" name="payment_reference"><br>

Amount of Holding Deposit:<br>
<select>
    <option value="4">4 weeks</option>
    <option value="5">5 weeks</option>
</select><br>

Amount of Tenant(s):<br>
<select>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">9+</option>
</select><br>

<br>
<input type="submit">
</form>
</body>
</html>




Calculation Required:
%ENTER 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS% <br>
%OFFER*30% <br>
%ENTER TODAYS DATE% <br>
%ENTER DEPOSIT 4 or 5 WEEKS IN NUMBERS% <br>
%ENTER TOTAL LESS 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS% <br>
%IF AMOUNT OF TENANT=1 -> (you will need to complete)elseif AMOUNT OF TENANT=2 -> (you both will need to complete) else -> (you all will need to complete)%  <br>


    
