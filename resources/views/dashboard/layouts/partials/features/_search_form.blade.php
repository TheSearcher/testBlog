<div>
    <div class="row">
        <div class="">
            <div class="card">
                <div class="card-body">
                    <form id="page-search-form" method="POST" >
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-auto mb-2">
                                <label>ID</label>
                                <input  type="text"
                                        class="form-control form-control-sm" style="width: 100px"/>
                            </div>
                            <div class="col-auto mb-2">
                                <label>Customer ID</label>
                                <input type="text"
                                       class="form-control form-control-sm" style="width: 100px"/>
                            </div>

                            <div class="col-auto mb-2">
                                <label>Company</label>
                                <input  type="text"
                                        class="form-control form-control-sm"/>
                            </div>
                            <div class="col-auto mb-2">
                                <label>Lastname</label>
                                <input  type="text"
                                        class="form-control form-control-sm"/>
                            </div>
                            <div class="col-auto mb-2">
                                <label>City</label>
                                <input  type="text"
                                        class="form-control form-control-sm"/>
                            </div>

                            {{--
                                                        {!! Form::select('profile[hair_length_id]',$dataList['indexHairLengthList'] , $user->profile->hair_length_id, ['placeholder' => 'Hair Length...', 'class' => 'form-select form-select-lg mb-3']) !!}
                            --}}

                            {{--<div class="col-auto mb-2">
                                <label>Country</label>
                                <select wire:model="search.country_id" class="form-control form-control-sm"
                                        style="max-width: 200px">
                                    <option value="">all countries</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>--}}

                            <div class="col-auto mb-2">
                                <button type="submit" class="btn btn-danger waves-effect waves-ligh btn-sm">
                                    <span class=" " ></span>
                                    Refine Your Search
                                </button>
                                {{--@if($searchReset == true)
                                    <button type="button" class="btn btn-warning waves-effect waves-ligh btn-sm"
                                            wire:click="searchReset">
                                        Reset
                                    </button>
                                @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
