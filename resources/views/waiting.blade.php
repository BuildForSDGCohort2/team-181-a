@extends('layouts.app', ['activePage' => 'notifications', 'titlePage' => __('Table List')])

@section('content')


<div class="content">

    <div class="container-fluid">
        <nav>

            <ul class="nav nav-pills">

                <li class="nav-item">
                    <a class="nav-link " href="{{route('issues')}}">Issues</a>
                </li>
                <a class="nav-link active" style="background-color: blueviolet" href="#">Farmer Requests</a>

                </li>
            </ul>


        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-info">
                        <h4 class="card-title ">Pending Farmers Requests</h4>
                        <p class="card-category"> Requests Subitted from Farmers</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" ">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Service
                                    </th>
                                    <th>
                                        Patient
                                    </th>

                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>

                                    @forelse ($requests as $request)
                                    <tr>
                                        <td>
                                            {{ucfirst($request->id)}}
                                        </td>

                                        <td>
                                            @php
                                            $services = explode('-',$request->service);
                                            $animal = App\Animal::find($request['animal_id']);
                                            @endphp
                                            {{in_array('ai',$services)?'Airtificial Insemination':''.
                        (in_array('ij',$services)?' Look into Injury ':'').
                        (in_array('chkup',$services)?'Checkup':'').(in_array('sale',$services)?'Sale Verification':'')
                        }}
                                        </td>
                                        
                                        <td>
                                        
                                            {{' A '.$animal->gender.' '.ucfirst($animal->breed->breed).' '.$animal->species }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-info"
                                                data-toggle="modal" data-target="#professional_modal"
                                                @click="open_issue({{ $request->id }}, 'summon_request')">View </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>
                                            <span class="text-primary"> No Requests</span>
                                        </td>
                                        <td>
                                            <span class="text-primary"> No Requests</span>
                                        </td>
                                        <td>
                                            <span class="text-primary"> No Requests</span>
                                        </td>
                                        <td>
                                            <span class="text-primary"> No Requests</span>
                                        </td>
                                        <td>
                                            <span class="text-primary"> No Requests</span>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- {{ $issues->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="professional_modal" class="modal fade" role="dialog" style="margin-top: 10%">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black"> Issue <span
                        style="color: rgb(255, 179, 0)">@{{ issues_show.identifier }}</span></h4>
                {{-- <small  class="form-text text-muted">Successful Applicants will Recieve confirmatory email</small> --}}

            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="(issue, index) in issues_show.service_arr" :key="issue.id">
                        <b>Reason:</b>
                        <span style="margin-left: 30px" v-if="issue == 'sale'">Sale <el-button style="float: right"
                                type="primary" :loading="false"
                                @click="issue_update('issue_req/' + issues_show.id + '/' + issue)">@{{ req.sale_text }}
                            </el-button></span>
                        <span style="margin-left: 30px" v-if="issue == 'ij'">Injury <el-button style="float: right"
                                type="primary" :loading="false"
                                @click="issue_update('issue_req/' + issues_show.id + '/' + issue)">@{{ req.ij_text }}
                            </el-button></span>
                        <span style="margin-left: 30px" v-if="issue == 'ai'">Ai samination <el-button
                                style="float: right" type="primary" :loading="false"
                                @click="issue_update('issue_req/' + issues_show.id + '/' + issue)">@{{ req.ai_text }}
                            </el-button></span>
                    </li>
                    {{-- <li class="list-group-item"><b>Reason:</b> <span style="margin-left: 30px">@{{ issues_show.reason }}</span>
                    </li> --}}
                </ul>

                <div class="form-group">
                    <label for="species"><small>Send a message to the farmer</small> </label>
                    <textarea class="form-control" v-model="form.message" id="recomendations" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-info" @click="save_item_data('send_message/' + issues_show.id)">Send Message</button>
                <button type="button" class="btn btn-sm btn-outline-info" @click="issue_update('issue_req/' + issues_show.id + '/well')">Animal is well</button>
            </div>

        </div>
    </div>
</div>
@endsection
