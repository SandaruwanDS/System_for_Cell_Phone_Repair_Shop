<table class="table table-bordered table-center table-hover datatable " id="customerTable">
    <thead >
        <tr class="table-secondary">

            <th>Job No</th>
            <th>Name</th>
            <th>Tel</th>
            <th>Brand</th>
            <th>Model</th>
            <th>IMEI Number</th>
            <th>Amount</th>
            <th>Advance</th>
            <th>Balance</th>
            <th>Password</th>
            <th>Problem Reported</th>
            <th>Product Configuration</th>
            <th>Technician</th>
            <th>Items</th>
            <th>Problems</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($jobSheets as $key=>$data)
        <tr>
            <td>{{$data->Job_no}}</td>
            <td>{{$data->Customer_Name}}</td>
            <td>{{$data->Customer_Phone}}</td>
            <td>{{$data->Brand}}</td>
            <td>{{$data->Device_Model}}</td>
            <td>{{$data->IMEI_Number}}</td>
            <td>{{$data->Amount}}</td>
            <td>{{$data->Advance}}</td>
            <td>{{$data->Balance}}</td>
            <td>{{$data->Password}}</td>
            <td>{{$data->Problem_Reported}}</td>
            <td>{{$data->Product_Configuration}}</td>
            <td>{{$data->Technician}}</td>
            <td>{{$data->Item}}</td>
            <td>{{$data->Problem}}</td>
            <td>{{$data->Date}}</td>

            <td>
                @if ($data->Status == 'Pending')
                <span style="color: rgb(245, 208, 0)">Pending</span>
                @elseif ($data->Status == 'Complete')
                <span style="color: rgb(12, 252, 4)">Complete</span>
                @elseif ($data->Status == 'Delivered')
                <span style="color: rgb(43, 20, 247)">Delivered</span>
                @else
                <span style="color: rgb(252, 25, 25)">Job Failed</span>
                @endif              
            </td>

            <td>
                {{-- ..............Edit button................................. --}}
                {{-- <button type="button" class="btn btn-sm btn-success bg-success-light text-success me-2" data-bs-toggle="modal"
                    data-bs-target="#edit-customer-{{$data->Code}}">
                    <i class="far fa-edit me-1"></i> Edit
                </button> --}}
                <a href=""
                    class="btn btn-sm btn-success update_job_form bg-success-light text-success me-2"
                    data-bs-toggle="modal" data-bs-target="#updateJobModel"
                    data-id="{{$data->id}}"
                    data-job_no="{{$data->Job_no}}"
                    data-name="{{$data->Customer_Name}}"
                    data-contact1="{{$data->Customer_Phone}}"
                    data-brand="{{$data->Brand}}"
                    data-model="{{$data->Device_Model}}"
                    data-imei_no="{{$data->IMEI_Number}}"
                    data-amount="{{$data->Amount}}"
                    data-advance="{{$data->Advance}}"
                    data-balance="{{$data->Balance}}"
                    data-configuration="{{$data->Product_Configuration}}"
                    data-password="{{$data->Password}}"
                    data-problem_reported="{{$data->Problem_Reported}}"
                    data-condition="{{$data->Product_Condition}}"
                    data-technician="{{$data->Technician}}"
                    data-date="{{$data->Date}}"
                    data-items="{{$data->Item}}"
                    data-problems="{{$data->Problem}}"
                    data-status="{{$data->Status}}"
                     >
                    <i class="far fa-edit me-1"></i> Edit
                </a>

                <button type="button" class="btn btn-sm delete_job btn-danger bg-danger-light text-danger me-2"
                data-id="{{$data->id}}">
                    <i class="far fa-trash-alt me-1"></i> Delete
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $jobSheets->links() !!}
