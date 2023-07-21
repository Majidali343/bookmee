@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Words Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="top-part d-flex justify-content-between margin-bottom-40">
                            <div class="left-item">
                                <h4 class="header-title">{{__("Change All Words")}}</h4>
                                <button
                                        class="btn btn-secondary btn-xs"
                                        data-toggle="modal"
                                        data-target="#view_quote_details_modal"
                                >{{__('Add New Word')}}</button>
                                <a href="#" id="regenerate_source_text_btn" class="btn btn-warning ">{{__('Regenerate Source Texts')}}</a>
                            </div>
                            <div class="btn-wrapper">
                                <a href="{{route('admin.languages')}}" class="btn btn-info">{{__('All Languages')}}</a>
                            </div>
                        </div>
                        <p class="text-info margin-bottom-20">{{__('select any source text to translate it, then enter your translated text in textarea hit update')}}</p>
                        <div class="language-word-translate-box">
                            <div class="search-box-wrapper">
                                <input type="text" name="word_search" id="word_search" placeholder="{{__('Search Source Text...')}}">
                            </div>
                            <div class="top-part">
                                <div class="single-string-wrap">
                                    <div class="string-part">{{__('Source Text')}}</div>
                                    <div class="translated-part">{{__('Translation')}}</div>
                                </div>
                            </div>
                            <div class="middle-part">
                                @foreach($all_word as $key => $value)
                                    <div class="single-string-wrap">
                                        <div class="string-part" data-key="{{$key}}">{{$key}}</div>
                                        <div class="translated-part" data-trans="{{$value}}">{{$key === $value ? '' : $value}}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="footer-part">
                                <h6 id="selected_source_text"><span>{{__('Source Text:')}}</span> <strong class="text"></strong></h6>
                                <form action="{{route('admin.languages.words.update',$lang_slug)}}" method="POST" id="langauge_translate_form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="type" value="{{$type}}">
                                    <input type="hidden" name="string_key">
                                    <div class="from-group">
                                        <label for="">{{__('Translate To')}} <strong>{{$language->name}}</strong></label>
                                        <textarea name="translate_word" cols="30" rows="5" class="form-control" placeholder="{{__('enter your translate words')}}"></textarea>
                                    </div>
                                    <button type="submit" id="language_update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view_quote_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add New Translate able String')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.languages.add.new.word')}}" id="user_password_change_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="lang_slug" id="lang_slug" value="{{$lang_slug}}">
                        <div class="form-group">
                            <label for="new_string">{{__('String')}}</label>
                            <input type="text" class="form-control" name="new_string" placeholder="{{__('new string')}}">
                        </div>
                        <div class="form-group">
                            <label for="translated_string">{{__('Translated String')}}</label>
                            <input type="text" class="form-control" id="translated_string" name="translate_string" placeholder="{{__('Translated String')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Add New String')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
            "use strict";

            $(document).ready(function (){
                $(document).on('click','#language_update',function (e){
                   e.preventDefault();
                   
                   let url =  "{{route('admin.languages.words.update',$lang_slug)}}";
                   let translateWord = $('textarea[name="translate_word"]').val();
                   let stringKey = $('input[name="string_key"]').val();
                   $.ajax({
                      url: url, 
                      type: "post", 
                      data: {
                          _token : "{{csrf_token()}}",
                          translate_word: translateWord,
                          string_key: stringKey,
                      }, 
                      success: function(data){
                          console.log(data)
                           Swal.fire({
                                title: '{{__("Success")}}',
                                text: '{{__("translate success")}}',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                      }
                   });
                   
                   
                   
                });
                
                $(document).on('click','.language-word-translate-box .middle-part .single-string-wrap .string-part',function (e){
                   e.preventDefault();
                   let langKey = $(this).data('key');
                   let langValue = $(this).next().data('trans');
                   let formContainer = $('#langauge_translate_form');
                   $('#selected_source_text strong').text(langKey);
                   formContainer.find('input[name="string_key"]').val(langKey);
                   formContainer.find('textarea[name="translate_word"]').val(langValue);
                });
                //search source text
                $(document).on('keyup','#word_search',function (e){
                    e.preventDefault();
                    let searchText = $(this).val();
                    var allSourceText = $('.language-word-translate-box .middle-part .single-string-wrap .string-part');
                    $.each(allSourceText,function (index,value){
                        var text = $(this).text();
                        var found = text.toLowerCase().match(searchText.toLowerCase().trim());
                        if (!found){
                            $(this).parent().hide();
                        }else{
                            $(this).parent().show();
                        }
                    });
                });

                $(document).on('click','#regenerate_source_text_btn',function (e){
                    e.preventDefault();
                   //admin.languages.regenerate.source.texts
                    Swal.fire({
                        title: '{{__("Are you sure?")}}',
                        text: '{{__("It will delete current source texts, you will lose your current translated data!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, Generate!')}}",
                        cancelButtonText: "{{__('Yes, Cancel!')}}",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: "{{route('admin.languages.regenerate.source.texts')}}",
                                data: {
                                    _token : "{{csrf_token()}}",
                                    slug : "{{$language->slug}}"
                                },
                                success : function (){
                                    toastr.success("{{__('source text generate success')}}")
                                    location.reload();
                                }
                            });
                        }
                    });

                });

            });

        })(jQuery);
    </script>
@endsection