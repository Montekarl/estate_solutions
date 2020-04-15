<html>
    <head>
        <title>Reservation Deposit Form and Email</title>
    </head>
<body>
    
<?php echo $_POST["name"]; ?><br>
<?php echo $_POST["number"]; ?><br>
<?php echo $_POST["email"]; ?><br>
<?php echo $_POST["full_address"]; ?><br>   
<?php echo $_POST["postcode"]; ?><br>   
<?php echo $_POST["move_in_date"]; ?><br>   
<?php echo $_POST["offer_in_numbers"]; ?><br>   
<?php echo $_POST["payment_reference"]; ?><br> 
   
<h3>Reservation Deposit Form</h3><br>

<pre>
Tenant Name (for and behalf of all tenants): <b><?php echo $_POST["name"]; ?></b>
Tenant Contact Details: <b><?php echo $_POST["number"]." / ". $_POST["email"]; ?></b>
Property Address: <b><?php echo $_POST["full_address"]; ?></b>
Property Postcode: <b><?php echo $_POST["postcode"]; ?></b>
Move In Date Agreed: <b><?php echo $_POST["move_in_date"]; ?></b>
Rent Agreed: <b>£<?php echo $_POST["offer_in_numbers"]; ?></b>
Amount Of Reservation/ Holding Deposit To Be Paid: <b>£<?php echo round($_POST["offer_in_numbers"]*12/52,-1); ?></b>

The Landlord has agreed to remove the above property from the Letting Market subject to 
the receipt of satisfactory references and you entering into a formal agreement within 14 
days or later only if agreed prior. 

The tenants agree: 
    •  That they do not have any Pets and do not intend getting any Pets during the 
    tenancy or any extension thereof. 
    •  That they are and have been residents in England for a continuous period of a 
    minimum of 12 months till this point. 
    •  That they are in full time employment and earning a minimum gross annual salary 
    of <b>£<?php echo number_format(round($_POST["offer_in_numbers"]*30,-3)); ?></b> as a mandatory requirement to pass referencing on this property, 
    which can either be a single income or joint income for joint tenancies. 
    
Once the deposit has been paid; should you or any joint tenants decide not to proceed 
with the rental of the property or you do not enter into a formal agreement with the 
Landlord within 14 days or later only if agreed prior; then your £<b><u>%ENTER 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS%</b></u> deposit is non-
refundable. 

If the Landlord decides not to let the property to you due to you or any joint tenant’s: 
    •  Failure to disclose that you have Pets 
    •  Given false information  
    •  Given misleading information  
    •  Failing a Right to Rent check 
Then your £<b><u>%ENTER 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS%</b></u> deposit is non-refundable. 

Dated: <b><u>%ENTER TODAYS DATE%</b></u>

I/we have read the terms and conditions as above and payment to 
Benson & Partners Ltd of the initial Holding Deposit confirms that we 
agree to the above terms and conditions. 
</pre>
<br> <h3>Email</h3>
<pre>
Dear Jeanette and Annan,
 
Firstly congratulations! 
 
The letting of ’<b><u>%ENTER FULL PROPERTY ADDRESS%</b></u>’ has been agreed by your new Landlord; subject to referencing.
 
The move-in date of ‘<b><u>%ENTER MOVE-IN DATE%</b></u>’ has been agreed.
 
Your total move-in balance is as below:
Rent in advance = £<b><u>%ENTER OFFER IN NUMBERS%</b></u>
Deposit = £<b><u>%ENTER DEPOSIT 4 or 5 WEEKS IN NUMBERS%</b></u>
TOTAL = £<b><u>%ENTER DEPOSIT 4 or 5 WEEKS IN NUMBERS% + %ENTER OFFER IN NUMBERS%</b></u>
 
The above balance will need to be paid as follows:
Holding Deposit to be paid as soon as possible = £<b><u>%ENTER 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS%</b></u>
Move in balance will need to be paid 1 day before your move in date = £<b><u>%ENTER TOTAL LESS 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS%</b></u>
TOTAL = £<b><u>%ENTER DEPOSIT 4 or 5 WEEKS IN NUMBERS% + %ENTER OFFER IN NUMBERS%</b></u>
 
Firstly, please read the attached ‘Reservation Deposit Form’ and if you are happy to proceed then transfer your £<b><u>%ENTER 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS%</b></u> Holding Deposit to the following account:
BANK = Barclays Bank PLC
ACC NAME = Benson & Partners Ltd
SORT CODE = 20 – 24 – 61
ACC NO = 30108413
QUOTE REFERENCE = <b><u>%ENTER PAYMENT REFERENCE%</b></u>
AMOUNT = £<b><u>%ENTER 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS%</b></u> (Two Hundred and Ten Pounds)
(Please confirm via email when the above payment has been made and we will then remove the property from the market on receipt of your holding deposit)
 
Please see the attached <b><u>%ENTER AMOUNT OF TENANTS</b></u> copies of ‘Reference Form’ that  <b><u>IF AMOUNT OF TENANT=1 -> (you will need to complete)elseif AMOUNT OF TENANT=2 -> (you both will need to complete) else -> (you all will need to complete)</b></u>.
Please Do Not fill Box’s 1 to 3 on Page 1.
You need to start filling in from Box 4 on Page 1 titled ‘Applicant’s contact details’
Please print the attached referencing forms; complete it and then return it by email to our office once completed; along with the following:
Passport
Immigration Documents (If you have a Non UK or EU Passport)
Last 3 months bank statements 
Last 3 months payslips 
(Please send the above listed forms and documents via email to vipin@bensonpartners.co.uk and please make sure the items are all coloured and clear to view (Pictures of documents will Not be accepted)). 
(Alternately, you could bring the original documents to our office: Benson & Partners, 4-6 Station Road, South Norwood, London, SE25 5AJ).
 
1 day before your move in date; your moving in balance will need to be paid into the following account:
BANK = Barclays Bank PLC
ACC NAME = Benson & Partners Ltd (Clients Premium)
SORT CODE = 20 – 24 – 61
ACC NO = 30108413
QUOTE REFERENCE = <b><u>%ENTER PAYMENT REFERENCE%</b></u>
AMOUNT = £<b><u>%ENTER TOTAL LESS 1 WEEK OF RENTAL ROUNDED UP TO DECIMALS%</b></u> (One Thousand, Five Hundred & Ninety Pounds)


Kind Regards,

Vipin Nayyar
020 8653 3444
vipin@bensonpartners.co.uk
Benson & Partners Ltd
    
</pre>
</body>
</html>