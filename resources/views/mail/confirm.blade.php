<p> Hello Mr/Mrs {{ucfirst($new_user['name'])}}</p>
<p> We Hope this finds you well..  </p>
@component('mail::panel')
<p> Folowing  request to join our company  request on the {{$new_user->created_at}}, we are glad to inform you that it was very successfull. To log in Please click on the link bellow, use the email u applied with and the id number you provided</p>
@endcomponent
@component('mail::button', ['url' => 'http://farmersassistant.herokuapp.com/login', 'color' => 'success'])
    Log In 
@endcomponent
<p>Welcome To Our honourable Course</p>
<p> Regards </p>
<p> The Farmers Assistant Family. </p>