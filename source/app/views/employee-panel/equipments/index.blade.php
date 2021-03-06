<!-- Page title -->
@section('title')
    Equipment List
@stop

<!-- Page content to add in master layout -->
@section('content')

    <!-- Top header bar of the page. See top_bar layouts -->
    @include('layouts.top_bar')

    <div class="container-fluid">
        <div class="row-fluid">

            <div class="span12" id="content">

                <!-- Display flash message here -->
                <div class="row-fluid">
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-check-circle"></i> {{ Session::get('success_message') }}
                    </div>
                    @endif
                </div>

                <div class="row-fluid">
                   <!-- block -->
                   <div class="block">

                       <!-- block header -->
                       <div class="navbar navbar-inner block-header">
                           <div class="muted pull-left">Equipment List</div>
                           <div class="pull-right"><a href="{{ URL::to('/employee-panel/equipments/create') }}">Create</a></div>
                       </div>

                       <!-- block content -->
                       <div class="block-content collapse in">
                           <div class="span12">

                               <!-- table -->
                                 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                   <thead>
                                       <tr>
                                           <th class="index-th">#</th>
                                           <th>Equipment Name</th>
                                           <th>Quantity</th>
                                           <th>Status</th>
                                           <th></th>
                                       </tr>
                                   </thead>

                                   <tbody>
                                       @foreach($equipments as $key => $value)
                                       <tr class="gradeA">
                                           <td>
                                               {{ $key+1 }}
                                           </td>

                                           <td>
                                               <a href="{{ URL::to('/employee-panel/equipments/'. $value->id) }}">{{ $value->name }}
                                               </a>
                                           </td>


                                           <td>
                                               {{ $value->quantity }}
                                           </td>


                                           <td>
                                               @if($value->status == 1)
                                                    <i class="fa fa-check-square" style="color:green;"></i> Approved
                                               @elseif($value->status == 2)
                                                    <i class="fa fa-times" style="color:red;"></i> Rejected
                                               @else
                                                    <i class="fa fa-clock-o" style="color:orange;"></i> Pending
                                               @endif
                                           </td>

                                           <td class="vert-align">
                                               @if($value->status == 3)
                                               <a href="#" onClick="confirmAction('<b>{{ $value->name }}</b>', '/employee-panel/equipments/{{ $value->id }}')" class="btn btn-danger btn-mini">
                                                   <i class="icon-trash icon-white"></i> Delete
                                               </a>

                                                <a href="{{ URL::to('/employee-panel/equipments/'.$value->id.'/edit') }}" class="btn btn-primary btn-mini">
                                                    <i class="icon-edit icon-white"></i> Edit
                                                </a>
                                                @else
                                                    <button class="btn btn-danger btn-mini disabled">
                                                        <i class="icon-trash icon-white"></i> Delete
                                                    </button>

                                                     <button class="btn btn-primary btn-mini disabled">
                                                         <i class="icon-edit icon-white"></i> Edit
                                                     </button>
                                                @endif
                                           </td>

                                       </tr>

                                       @endforeach
                                   </tbody>
                               </table>

                               <!-- delete confirmation modal -->
                               <div id="confirmActionModal" class="modal hide">
                                   <div class="modal-header">
                                       <button data-dismiss="modal" class="close" type="button">&times;</button>
                                       <h3>Alert!</h3>
                                   </div>
                                   <div class="modal-body">
                                       <p>Do you want to delete?</p>
                                   </div>
                                   <div class="modal-footer">
                                       <a data-dismiss="modal" id="confirmActionButton" class="btn btn-primary danger" href="#" >Confirm</a>
                                       <a data-dismiss="modal" class="btn" href="#">Cancel</a>
                                   </div>
                               </div>
                           </div>
                       </div>

                   </div>
                   <!-- /block -->
               </div>

            </div>
        </div>
    </div>
@stop

<!-- Specefic  javascripts section for this page -->
@section('js_scripts')
    @include('layouts.js_scripts.employee_master')
    {{ HTML::script('/js/confirm.js'); }}
@stop
