@component('mail::message')
<div style="padding:40px;">
    <h1>Bank Transfer</h1>
    <p>In this email we have included the payment information for your payment to Test profile. Use this data only for the completion of this particular payment. Please make sure that you fill in all the details correctly.</p>
    <p><b style="margin-right:40px;">BENEFICIARY</b> Globale trading</p>
    <p><b style="margin-right:40px;">IBAN</b> BE76 1431 0026 8395</p>
    <p><b style="margin-right:40px;">BIC</b> GEBABEBB</p>
    <p><b style="margin-right:40px;">AMOUNT</b> {{formatPrice($EmailData->total + $EmailData->total_tax + $EmailData->total_shipping).getCurrency()['symbole']}}</p>
    <p><b style="margin-right:40px;">REFERENCE</b> <span style="border:1px solid green;padding:4px;border-radius:4px;">{{$EmailData->serial_number}}</span></p>
    <p>Enter this reference as the <b>Payment Reference</b> of the bank transfer. Or simply include it in the description.</p>
    <p><b>Please note:</b> Your order will be processed only after we have received the payment and you have limit of 10 days to make the transaction or you order will be automatically deleted</p>
    Thanks,<br>
    UK Fashion Shop LLC
  </div>
  @endcomponent
