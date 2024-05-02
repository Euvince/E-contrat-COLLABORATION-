@extends('layouts.master')
@section('title')
    {{ " Detail de l'utilisateur $user->nom $user->prenom" }}
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="card rounded-0 ">
        <div class="card-header">
            <h2 class="card-title">
                {{ "$user->nom $user->prenom" }}
            </h2>
        </div>
        <div class="card-body">
                <div class="py-2 row d-flex justify-content-center">

                    <div class="py-2 row d-flex justify-content-center">

                        <div class="mb-3 col-md-6">
                            <label for="basiInput" class="form-label">UFR</label>
                            <select class="form-control js-example-templating" name="ufr_id" disabled>
                                @foreach($universites as $universite)
                                    <optgroup label="{{$universite->nom}}">
                                        @foreach($universite->ufrs as $ufr)
                                            <option {{ $ufr->id == $user->ufr_id ? 'selected' : '' }} value="{{$ufr->id}}">
                                            <span>
                                                <img src="{{$ufr->logo}}" alt="logo" height="30" width="30">
                                            </span>
                                                <span>{{$ufr->nom}}</span>
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('ufr_id')
                            <span class="text-danger"> {{ $errors->first('ufr_id') }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="basiInput" class="form-label">Rôle</label>
                            <select disabled class="form-control js-example-templating" name="role_id">
                                @foreach($roles as $role)
                                    <option {{ $user->hasRole($role->name) ? 'selected' : '' }} value="{{$role->id}}">
                                        <span>{{$role->name}}</span>
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <span class="text-danger"> {{ $errors->first('role_id') }}</span>
                            @enderror
                        </div>
                        <div class=" mb-3 col-md-6">
                            <label for="basiInput" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input disabled type="text" placeholder="" class="form-control @error('nom') is-invalid @enderror"
                                   name="nom"
                                   value="{{ old('nom', $user->nom) }}" id="basiInput">
                            @error('nom')
                            <span class="text-danger"> {{ $errors->first('nom') }}</span>
                            @enderror
                        </div>
                        <div class=" mb-3  col-md-6">
                            <label for="basiInput" class="form-label">Prénoms <span class="text-danger">*</span></label>
                            <input disabled type="text" placeholder="" class="form-control @error('prenom') is-invalid @enderror"
                                   name="prenom"
                                   value="{{ old('prenom',$user->prenom) }}" id="basiInput">
                            @error('prenom')
                            <span class="text-danger"> {{ $errors->first('prenom') }}</span>
                            @enderror
                        </div>


                        <div class="col-md-12 mb-3 ">
                            <label for="basiInput" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" placeholder="" class="form-control @error('email') is-invalid @enderror"
                                   name="email" disabled
                                   value="{{ old('email', $user->email) }}" id="basiInput">
                            @error('email')
                            <span class="text-danger"> {{ $errors->first('email') }}</span>
                            @enderror
                        </div>
{{--                        <div class="col-md-6 mb-3 ">--}}
{{--                            <label for="basiInput" class="form-label">Mot de Passe <span--}}
{{--                                    class="text-danger">*</span></label>--}}
{{--                            <input type="password" placeholder=""--}}
{{--                                   class="form-control @error('password') is-invalid @enderror"--}}
{{--                                   name="password"--}}
{{--                                   value="{{ old('password') }}" id="basiInput">--}}
{{--                            @error('password')--}}
{{--                            <span class="text-danger"> {{ $errors->first('password') }}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

                        <div class="col-md-6 mb-3 ">
                            <label for="basiInput" class="form-label">Téléphone <span class="text-danger">*</span></label>
                            <input required type="text" placeholder="60606060" disabled
                                   class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                   value="{{ old('telephone',$user->telephone) }}" id="basiInput">
                            @error('telephone')
                            <span class="text-danger"> {{ $errors->first('telephone') }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label for="basiInput" class="form-label">Sexe <span class="text-danger">*</span></label>
                            <select disabled required name="sexe" class="form-control" value="{{ old('sexe') }}" id="basiInput"
                                    @error('sexe') is-invalid @enderror">
                            <option {{old('sexe', $user->sexe)== 'Masculin' ? 'selected' : ''}} value="Masculin">Masculin</option>
                            <option {{old('sexe',$user->sexe)== 'Féminin' ? 'selected' : ''}} value="Féminin">Féminin</option>
                            <option {{old('sexe',$user->sexe)== 'Autre' ? 'selected' : ''}} value="Autre">Autre</option>
                            </select>
                            @error('sexe')
                            <span class="text-danger"> {{ $errors->first('sexe') }}</span>
                            @enderror
                        </div>


                        {{--                            <label for="basiInput" class="form-label">Avatar</label>--}}
                        <div>
                            <label for="basiInput" class="form-label">Avatar <span
                                    class="text-danger">*</span></label>
                            @error('avatar')
                            <span class="text-danger"> {{ $errors->first('avatar') }}</span>
                            @enderror
                            <div class="dropzone">
                                <div class="dz-message needsclick">
                                    <div class="mb-3 ">
                                        <img data-dz-thumbnail class="img-fluid rounded d-block" src="{{old('avatar', "storage/{$user->avatar}")}}"
                                             alt=""/>
                                    </div>

                                </div>
                            </div>

{{--                            <ul class="list-unstyled mb-0" id="dropzone-preview">--}}
{{--                                <li class="mt-2" id="dropzone-preview-list">--}}
{{--                                    <!-- This is used as the file preview template -->--}}
{{--                                    <div class="border rounded">--}}
{{--                                        <div class="d-flex p-2">--}}
{{--                                            <div class="flex-shrink-0 me-3">--}}
{{--                                                <div class="avatar-sm bg-light rounded">--}}
{{--                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="{{old('avatar', $user->avatar)}}"--}}
{{--                                                         alt="Product-Image"/>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-grow-1">--}}
{{--                                                <div class="pt-1">--}}
{{--                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>--}}
{{--                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>--}}
{{--                                                    <strong class="error text-danger" data-dz-errormessage></strong>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-shrink-0 ms-3">--}}
{{--                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                            <!-- end dropzon-preview -->
                        </div>


                    </div>




                </div>
                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>

                     <a href="{{ route('users.edit', ['user' => $user->slug]) }}">
                        <button class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-check-line label-icon fs-16 me-2"></i> Editer</button>
                        </a>

                </div>

        </div>
    </div>
@endsection

@section('script')
    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>

{{--    <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>--}}
    <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/ecommerce-product-create.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
