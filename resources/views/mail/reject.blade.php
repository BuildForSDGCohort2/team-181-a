<p> Hello Mr/Mrs {{strtoupper($user->name)}}</p>
<p> We Hope this finds you well..  </p>
@component('mail::panel')
<p> Folowing your application on {{($user->created_at )}}, to join our Ranks , we are sorry to notify you that it was not succesfull . </p>
@endcomponent


<p> Regards </p>
<p> The Farmers Assistant </p>