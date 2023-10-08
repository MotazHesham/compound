@php
    $Villas=\App\Models\Villas::doesntHave('tenant')->take(7)->get();
    $ten=\App\Models\Tenant::orderBy('id','desc')->take(7)->get();
@endphp
<div class="row">
    <div class="col-sm-12 col-lg-8">
        <div class="card">
            <div class="card-body p-b-0">
                <h4 class="card-title">{{trans('admins.availableVillas')}}</h4>
                <div class="table-responsive">
                    <table class="table v-middle">
                        <thead>
                        <tr>
                            <th class="border-top-0">{{trans('admins.villaNumber')}}</th>
                            <th class="border-top-0">{{trans('admins.singleCompounds')}}</th>
                            <th class="border-top-0">{{trans('admins.number_of_rooms')}}</th>
                            <th class="border-top-0">{{trans('admins.number_of_bathrooms')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Villas as $row)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="m-r-10">
                                            <img src="{{getImageUrl('Villas',$row->image)}}" alt="user"
                                                 class="rounded-circle" width="45">
                                        </div>
                                        <div class="">
                                            <h4 class="m-b-0 font-16">{{$row->villa_number	}}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$row->compound->compound_name}}</td>
                                <td>{{$row->number_of_rooms}}</td>
                                <td class="font-medium">{{$row->number_of_bathrooms}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{trans('admins.lastTen')}}</h4>
                <div class="feed-widget scrollable" style="height:450px;">
                    <ul class="list-style-none feed-body m-0 p-b-20">
                        @foreach($ten as $row)
                            <li class="feed-item">
                                <div class="feed-icon bg-info">
                                    <i class="far fa-user"></i>
                                </div>
                                <a href="{{route('Tenant.show',$row->id)}}">{{$row->name}}</a>
                                <span class="ml-auto font-12 text-muted">{{$row->created_at}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
