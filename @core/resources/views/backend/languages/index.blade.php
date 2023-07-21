@extends('backend.admin-master')
@section('site-title')
    {{__('Language Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
            <x-msg.success/>
            <x-msg.error/>
            </div>
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Languages')}}</h4>
                        <table class="table table-default">
                            <thead>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Direction')}}</th>
                            <th>{{__('Slug')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Default')}}</th>
                            <th>{{__('Action')}}</th>
                            </thead>
                            <tbody>
                            @foreach($all_lang as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{strtoupper($data->direction)}}</td>
                                    <td>{{$data->slug}}</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                        @can('language-edit')
                                            @if($data->default == 1)
                                                <a href="javascript:void(0)"
                                                   class="btn btn-lg btn-success btn-sm mb-3 mr-1">{{__("Default")}}</a>
                                            @elseif($data->status === 'publish')
                                            <x-change-default-lang :url="route('admin.languages.default',$data->id)"/>
                                            @endif
                                        @endcan
                                    </td>
                                    <td>
                                        @can('language-delete')
                                        @if($data->default != 1)
                                            <x-delete-popover :url="route('admin.languages.delete',$data->id)"/>
                                        @endif
                                        @endcan
                                        <a href="{{route('admin.languages.words.all',$data->slug)}}"
                                           title="{{__('Edit Frontend Words')}}" class="btn btn-info btn-xs mb-3 mr-1 text-white"
                                           >
                                            <i class="ti-pencil"></i> {{__('Edit All Words')}}
                                        </a>
                                     @can('language-edit')
                                        <a href="#"
                                           data-toggle="modal"
                                           data-target="#language_item_edit_modal"
                                           class="btn btn-primary btn-xs mb-3 mr-1 lang_edit_btn"
                                           data-id="{{$data->id}}"
                                           data-name="{{$data->name}}"
                                           data-slug="{{$data->slug}}"
                                           data-status="{{$data->status}}"
                                           data-direction="{{$data->direction}}"
                                        >
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <a href="#"
                                           data-toggle="modal"
                                           data-target="#language_item_clone_modal"
                                           class="btn btn-primary btn-xs mb-3 mr-1 lang_clone_btn"
                                           data-id="{{$data->id}}"
                                        >
                                            <i class="fas fa-copy"></i>
                                        </a>
                                         @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

          @can('language-create')
            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Language')}}</h4>
                        <form action="{{route('admin.languages.new')}}" method="post" enctype="multipart/form-data" class="new_language_form">
                            @csrf
                        <div class="form-group">
                            <label for="name">{{__('Language')}}</label>
                            <input type="hidden" name="name">
                            <select name="language_select" class="form-control">
                                    <option value="af" lang="af">Afrikaans</option>
                                    <option value="ar" lang="ar">العربية</option>
                                    <option value="ary" lang="ar">العربية المغربية</option>
                                    <option value="as" lang="as">অসমীয়া</option>
                                    <option value="az" lang="az">Azərbaycan dili</option>
                                    <option value="azb" lang="az">گؤنئی آذربایجان</option>
                                    <option value="bel" lang="be">Беларуская мова</option>
                                    <option value="bg_BG" lang="bg">Български</option>
                                    <option value="bn_BD" lang="bn">বাংলা</option>
                                    <option value="bo" lang="bo">བོད་ཡིག</option>
                                    <option value="bs_BA" lang="bs">Bosanski</option>
                                    <option value="ca" lang="ca">Català</option>
                                    <option value="ceb" lang="ceb">Cebuano</option>
                                    <option value="cs_CZ" lang="cs">Čeština</option>
                                    <option value="cy" lang="cy">Cymraeg</option>
                                    <option value="da_DK" lang="da">Dansk</option>
                                    <option value="de_CH" lang="de">Deutsch (Schweiz)</option>
                                    <option value="de_AT" lang="de">Deutsch (Österreich)</option>
                                    <option value="de_CH_informal" lang="de">Deutsch (Schweiz, Du)</option>
                                    <option value="de_DE" lang="de">Deutsch</option>
                                    <option value="de_DE_formal" lang="de">Deutsch (Sie)</option>
                                    <option value="dsb" lang="dsb">Dolnoserbšćina</option>
                                    <option value="dzo" lang="dz">རྫོང་ཁ</option>
                                    <option value="el" lang="el">Ελληνικά</option>
                                    <option value="en_US" lang="en">English (USA)</option>
                                    <option value="en_AU" lang="en">English (Australia)</option>
                                    <option value="en_GB" lang="en">English (UK)</option>
                                    <option value="en_CA" lang="en">English (Canada)</option>
                                    <option value="en_ZA" lang="en">English (South Africa)</option>
                                    <option value="en_NZ" lang="en">English (New Zealand)</option>
                                    <option value="eo" lang="eo">Esperanto</option>
                                    <option value="es_AR" lang="es">Español de Argentina</option>
                                    <option value="es_EC" lang="es">Español de Ecuador</option>
                                    <option value="es_MX" lang="es">Español de México</option>
                                    <option value="es_ES" lang="es">Español</option>
                                    <option value="es_VE" lang="es">Español de Venezuela</option>
                                    <option value="es_CO" lang="es">Español de Colombia</option>
                                    <option value="es_CR" lang="es">Español de Costa Rica</option>
                                    <option value="es_PE" lang="es">Español de Perú</option>
                                    <option value="es_PR" lang="es">Español de Puerto Rico</option>
                                    <option value="es_UY" lang="es">Español de Uruguay</option>
                                    <option value="es_GT" lang="es">Español de Guatemala</option>
                                    <option value="es_CL" lang="es">Español de Chile</option>
                                    <option value="es_DO" lang="es">Español de República Dominicana</option>
                                    <option value="et" lang="et">Eesti</option>
                                    <option value="eu" lang="eu">Euskara</option>
                                    <option value="fa_IR" lang="fa">فارسی</option>
                                    <option value="fa_AF" lang="fa">(فارسی (افغانستان</option>
                                    <option value="fi" lang="fi">Suomi</option>
                                    <option value="fr_FR" lang="fr">Français</option>
                                    <option value="fr_BE" lang="fr">Français de Belgique</option>
                                    <option value="fr_CA" lang="fr">Français du Canada</option>
                                    <option value="fur" lang="fur">Friulian</option>
                                    <option value="gd" lang="gd">Gàidhlig</option>
                                    <option value="gl_ES" lang="gl">Galego</option>
                                    <option value="gu" lang="gu">ગુજરાતી</option>
                                    <option value="haz" lang="haz">هزاره گی</option>
                                    <option value="he_IL" lang="he">עִבְרִית</option>
                                    <option value="hi_IN" lang="hi">हिन्दी</option>
                                    <option value="hr" lang="hr">Hrvatski</option>
                                    <option value="hsb" lang="hsb">Hornjoserbšćina</option>
                                    <option value="hu_HU" lang="hu">Magyar</option>
                                    <option value="hy" lang="hy">Հայերեն</option>
                                    <option value="id_ID" lang="id">Bahasa Indonesia</option>
                                    <option value="is_IS" lang="is">Íslenska</option>
                                    <option value="it_IT" lang="it">Italiano</option>
                                    <option value="ja" lang="ja">日本語</option>
                                    <option value="jv_ID" lang="jv">Basa Jawa</option>
                                    <option value="ka_GE" lang="ka">ქართული</option>
                                    <option value="kab" lang="kab">Taqbaylit</option>
                                    <option value="kk" lang="kk">Қазақ тілі</option>
                                    <option value="km" lang="km">ភាសាខ្មែរ</option>
                                    <option value="kn" lang="kn">ಕನ್ನಡ</option>
                                    <option value="ko_KR" lang="ko">한국어</option>
                                    <option value="ckb" lang="ku">كوردی‎</option>
                                    <option value="lo" lang="lo">ພາສາລາວ</option>
                                    <option value="lt_LT" lang="lt">Lietuvių kalba</option>
                                    <option value="lv" lang="lv">Latviešu valoda</option>
                                    <option value="mk_MK" lang="mk">Македонски јазик</option>
                                    <option value="ml_IN" lang="ml">മലയാളം</option>
                                    <option value="mn" lang="mn">Монгол</option>
                                    <option value="mr" lang="mr">मराठी</option>
                                    <option value="ms_MY" lang="ms">Bahasa Melayu</option>
                                    <option value="my_MM" lang="my">ဗမာစာ</option>
                                    <option value="nb_NO" lang="nb">Norsk bokmål</option>
                                    <option value="ne_NP" lang="ne">नेपाली</option>
                                    <option value="nl_NL" lang="nl">Nederlands</option>
                                    <option value="nl_BE" lang="nl">Nederlands (België)</option>
                                    <option value="nl_NL_formal" lang="nl">Nederlands (Formeel)</option>
                                    <option value="nn_NO" lang="nn">Norsk nynorsk</option>
                                    <option value="oci" lang="oc">Occitan</option>
                                    <option value="pa_IN" lang="pa">ਪੰਜਾਬੀ</option>
                                    <option value="pl_PL" lang="pl">Polski</option>
                                    <option value="ps" lang="ps">پښتو</option>
                                    <option value="pt_BR" lang="pt">Português do Brasil</option>
                                    <option value="pt_PT_ao90" lang="pt">Português (AO90)</option>
                                    <option value="pt_AO" lang="pt">Português de Angola</option>
                                    <option value="pt_PT" lang="pt">Português</option>
                                    <option value="rhg" lang="rhg">Ruáinga</option>
                                    <option value="ro_RO" lang="ro">Română</option>
                                    <option value="ru_RU" lang="ru">Русский</option>
                                    <option value="sah" lang="sah">Сахалыы</option>
                                    <option value="snd" lang="sd">سنڌي</option>
                                    <option value="si_LK" lang="si">සිංහල</option>
                                    <option value="sk_SK" lang="sk">Slovenčina</option>
                                    <option value="skr" lang="skr">سرائیکی</option>
                                    <option value="sl_SI" lang="sl">Slovenščina</option>
                                    <option value="sq" lang="sq">Shqip</option>
                                    <option value="sr_RS" lang="sr">Српски језик</option>
                                    <option value="sv_SE" lang="sv">Svenska</option>
                                    <option value="sw" lang="sw">Kiswahili</option>
                                    <option value="szl" lang="szl">Ślōnskŏ gŏdka</option>
                                    <option value="ta_IN" lang="ta">தமிழ்</option>
                                    <option value="ta_LK" lang="ta">தமிழ்</option>
                                    <option value="te" lang="te">తెలుగు</option>
                                    <option value="th" lang="th">ไทย</option>
                                    <option value="tl" lang="tl">Tagalog</option>
                                    <option value="tr_TR" lang="tr">Türkçe</option>
                                    <option value="tt_RU" lang="tt">Татар теле</option>
                                    <option value="tah" lang="ty">Reo Tahiti</option>
                                    <option value="ug_CN" lang="ug">ئۇيغۇرچە</option>
                                    <option value="uk" lang="uk">Українська</option>
                                    <option value="ur" lang="ur">اردو</option>
                                    <option value="uz_UZ" lang="uz">O‘zbekcha</option>
                                    <option value="vi" lang="vi">Tiếng Việt</option>
                                    <option value="zh_TW" lang="zh">繁體中文</option>
                                    <option value="zh_HK" lang="zh">香港中文版	</option>
                                    <option value="zh_CN" lang="zh">简体中文</option>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="direction">{{__('Direction')}}</label>
                        <select name="direction" id="direction" class="form-control">
                            <option value="ltr">{{__('LTR')}}</option>
                            <option value="rtl">{{__("RTL")}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">{{__('Status')}}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="publish">{{__('Publish')}}</option>
                            <option value="draft">{{__("Draft")}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slug">{{__('Slug')}}</label>
                        <input type="text" class="form-control" readonly name="slug">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New')}}</button>
                    </form>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>

 @can('language-edit')
    <div class="modal fade" id="language_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Language')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.languages.update')}}" class="edit_language_form" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="lang_id" value="">
                        <div class="form-group">
                            <label for="edit_name">{{__('Languages')}}</label>
                            <input type="hidden" name="name">
                            <select name="language_select" class="form-control">
                                <option value="af" lang="af">Afrikaans</option>
                                <option value="ar" lang="ar">العربية</option>
                                <option value="ary" lang="ar">العربية المغربية</option>
                                <option value="as" lang="as">অসমীয়া</option>
                                <option value="az" lang="az">Azərbaycan dili</option>
                                <option value="azb" lang="az">گؤنئی آذربایجان</option>
                                <option value="bel" lang="be">Беларуская мова</option>
                                <option value="bg_BG" lang="bg">Български</option>
                                <option value="bn_BD" lang="bn">বাংলা</option>
                                <option value="bo" lang="bo">བོད་ཡིག</option>
                                <option value="bs_BA" lang="bs">Bosanski</option>
                                <option value="ca" lang="ca">Català</option>
                                <option value="ceb" lang="ceb">Cebuano</option>
                                <option value="cs_CZ" lang="cs">Čeština</option>
                                <option value="cy" lang="cy">Cymraeg</option>
                                <option value="da_DK" lang="da">Dansk</option>
                                <option value="de_CH" lang="de">Deutsch (Schweiz)</option>
                                <option value="de_AT" lang="de">Deutsch (Österreich)</option>
                                <option value="de_CH_informal" lang="de">Deutsch (Schweiz, Du)</option>
                                <option value="de_DE" lang="de">Deutsch</option>
                                <option value="de_DE_formal" lang="de">Deutsch (Sie)</option>
                                <option value="dsb" lang="dsb">Dolnoserbšćina</option>
                                <option value="dzo" lang="dz">རྫོང་ཁ</option>
                                <option value="el" lang="el">Ελληνικά</option>
                                <option value="en_AU" lang="en">English (Australia)</option>
                                <option value="en_GB" lang="en">English (UK)</option>
                                <option value="en_US" lang="en">English (USA)</option>
                                <option value="en_CA" lang="en">English (Canada)</option>
                                <option value="en_ZA" lang="en">English (South Africa)</option>
                                <option value="en_NZ" lang="en">English (New Zealand)</option>
                                <option value="eo" lang="eo">Esperanto</option>
                                <option value="es_AR" lang="es">Español de Argentina</option>
                                <option value="es_EC" lang="es">Español de Ecuador</option>
                                <option value="es_MX" lang="es">Español de México</option>
                                <option value="es_ES" lang="es">Español</option>
                                <option value="es_VE" lang="es">Español de Venezuela</option>
                                <option value="es_CO" lang="es">Español de Colombia</option>
                                <option value="es_CR" lang="es">Español de Costa Rica</option>
                                <option value="es_PE" lang="es">Español de Perú</option>
                                <option value="es_PR" lang="es">Español de Puerto Rico</option>
                                <option value="es_UY" lang="es">Español de Uruguay</option>
                                <option value="es_GT" lang="es">Español de Guatemala</option>
                                <option value="es_CL" lang="es">Español de Chile</option>
                                <option value="es_DO" lang="es">Español de República Dominicana</option>
                                <option value="et" lang="et">Eesti</option>
                                <option value="eu" lang="eu">Euskara</option>
                                <option value="fa_IR" lang="fa">فارسی</option>
                                <option value="fa_AF" lang="fa">(فارسی (افغانستان</option>
                                <option value="fi" lang="fi">Suomi</option>
                                <option value="fr_FR" lang="fr">Français</option>
                                <option value="fr_BE" lang="fr">Français de Belgique</option>
                                <option value="fr_CA" lang="fr">Français du Canada</option>
                                <option value="fur" lang="fur">Friulian</option>
                                <option value="gd" lang="gd">Gàidhlig</option>
                                <option value="gl_ES" lang="gl">Galego</option>
                                <option value="gu" lang="gu">ગુજરાતી</option>
                                <option value="haz" lang="haz">هزاره گی</option>
                                <option value="he_IL" lang="he">עִבְרִית</option>
                                <option value="hi_IN" lang="hi">हिन्दी</option>
                                <option value="hr" lang="hr">Hrvatski</option>
                                <option value="hsb" lang="hsb">Hornjoserbšćina</option>
                                <option value="hu_HU" lang="hu">Magyar</option>
                                <option value="hy" lang="hy">Հայերեն</option>
                                <option value="id_ID" lang="id">Bahasa Indonesia</option>
                                <option value="is_IS" lang="is">Íslenska</option>
                                <option value="it_IT" lang="it">Italiano</option>
                                <option value="ja" lang="ja">日本語</option>
                                <option value="jv_ID" lang="jv">Basa Jawa</option>
                                <option value="ka_GE" lang="ka">ქართული</option>
                                <option value="kab" lang="kab">Taqbaylit</option>
                                <option value="kk" lang="kk">Қазақ тілі</option>
                                <option value="km" lang="km">ភាសាខ្មែរ</option>
                                <option value="kn" lang="kn">ಕನ್ನಡ</option>
                                <option value="ko_KR" lang="ko">한국어</option>
                                <option value="ckb" lang="ku">كوردی‎</option>
                                <option value="lo" lang="lo">ພາສາລາວ</option>
                                <option value="lt_LT" lang="lt">Lietuvių kalba</option>
                                <option value="lv" lang="lv">Latviešu valoda</option>
                                <option value="mk_MK" lang="mk">Македонски јазик</option>
                                <option value="ml_IN" lang="ml">മലയാളം</option>
                                <option value="mn" lang="mn">Монгол</option>
                                <option value="mr" lang="mr">मराठी</option>
                                <option value="ms_MY" lang="ms">Bahasa Melayu</option>
                                <option value="my_MM" lang="my">ဗမာစာ</option>
                                <option value="nb_NO" lang="nb">Norsk bokmål</option>
                                <option value="ne_NP" lang="ne">नेपाली</option>
                                <option value="nl_NL" lang="nl">Nederlands</option>
                                <option value="nl_BE" lang="nl">Nederlands (België)</option>
                                <option value="nl_NL_formal" lang="nl">Nederlands (Formeel)</option>
                                <option value="nn_NO" lang="nn">Norsk nynorsk</option>
                                <option value="oci" lang="oc">Occitan</option>
                                <option value="pa_IN" lang="pa">ਪੰਜਾਬੀ</option>
                                <option value="pl_PL" lang="pl">Polski</option>
                                <option value="ps" lang="ps">پښتو</option>
                                <option value="pt_BR" lang="pt">Português do Brasil</option>
                                <option value="pt_PT_ao90" lang="pt">Português (AO90)</option>
                                <option value="pt_AO" lang="pt">Português de Angola</option>
                                <option value="pt_PT" lang="pt">Português</option>
                                <option value="rhg" lang="rhg">Ruáinga</option>
                                <option value="ro_RO" lang="ro">Română</option>
                                <option value="ru_RU" lang="ru">Русский</option>
                                <option value="sah" lang="sah">Сахалыы</option>
                                <option value="snd" lang="sd">سنڌي</option>
                                <option value="si_LK" lang="si">සිංහල</option>
                                <option value="sk_SK" lang="sk">Slovenčina</option>
                                <option value="skr" lang="skr">سرائیکی</option>
                                <option value="sl_SI" lang="sl">Slovenščina</option>
                                <option value="sq" lang="sq">Shqip</option>
                                <option value="sr_RS" lang="sr">Српски језик</option>
                                <option value="sv_SE" lang="sv">Svenska</option>
                                <option value="sw" lang="sw">Kiswahili</option>
                                <option value="szl" lang="szl">Ślōnskŏ gŏdka</option>
                                <option value="ta_IN" lang="ta">தமிழ்</option>
                                <option value="ta_LK" lang="ta">தமிழ்</option>
                                <option value="te" lang="te">తెలుగు</option>
                                <option value="th" lang="th">ไทย</option>
                                <option value="tl" lang="tl">Tagalog</option>
                                <option value="tr_TR" lang="tr">Türkçe</option>
                                <option value="tt_RU" lang="tt">Татар теле</option>
                                <option value="tah" lang="ty">Reo Tahiti</option>
                                <option value="ug_CN" lang="ug">ئۇيغۇرچە</option>
                                <option value="uk" lang="uk">Українська</option>
                                <option value="ur" lang="ur">اردو</option>
                                <option value="uz_UZ" lang="uz">O‘zbekcha</option>
                                <option value="vi" lang="vi">Tiếng Việt</option>
                                <option value="zh_TW" lang="zh">繁體中文</option>
                                <option value="zh_HK" lang="zh">香港中文版	</option>
                                <option value="zh_CN" lang="zh">简体中文</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="direction">{{__('Direction')}}</label>
                            <select name="direction" id="edit_direction" class="form-control">
                                <option value="ltr">{{__('LTR')}}</option>
                                <option value="rtl">{{__("RTL")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_status">{{__('Status')}}</label>
                            <select name="status" id="edit_status" class="form-control">
                                <option value="publish">{{__('Publish')}}</option>
                                <option value="draft">{{__("Draft")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_slug">{{__('Slug')}}</label>
                            <input type="text" class="form-control" id="edit_slug" name="slug" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
    @can('language-edit')
    <div class="modal fade" id="language_item_clone_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Clone To New Languages')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <p class="alert alert-info">{{__('it will copy all content of all static sections, header slider, key features, contact info, support info, pages, menus')}}</p>
                <form action="{{route('admin.languages.clone')}}" id="contact_info_edit_modal_form" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="">

                        <div class="form-group">
                            <label for="edit_name">{{__('Name')}}</label>
                            <input type="hidden" name="name">
                            <select name="language_select" class="form-control">
                                <option value="af" lang="af">Afrikaans</option>
                                <option value="ar" lang="ar">العربية</option>
                                <option value="ary" lang="ar">العربية المغربية</option>
                                <option value="as" lang="as">অসমীয়া</option>
                                <option value="az" lang="az">Azərbaycan dili</option>
                                <option value="azb" lang="az">گؤنئی آذربایجان</option>
                                <option value="bel" lang="be">Беларуская мова</option>
                                <option value="bg_BG" lang="bg">Български</option>
                                <option value="bn_BD" lang="bn">বাংলা</option>
                                <option value="bo" lang="bo">བོད་ཡིག</option>
                                <option value="bs_BA" lang="bs">Bosanski</option>
                                <option value="ca" lang="ca">Català</option>
                                <option value="ceb" lang="ceb">Cebuano</option>
                                <option value="cs_CZ" lang="cs">Čeština</option>
                                <option value="cy" lang="cy">Cymraeg</option>
                                <option value="da_DK" lang="da">Dansk</option>
                                <option value="de_CH" lang="de">Deutsch (Schweiz)</option>
                                <option value="de_AT" lang="de">Deutsch (Österreich)</option>
                                <option value="de_CH_informal" lang="de">Deutsch (Schweiz, Du)</option>
                                <option value="de_DE" lang="de">Deutsch</option>
                                <option value="de_DE_formal" lang="de">Deutsch (Sie)</option>
                                <option value="dsb" lang="dsb">Dolnoserbšćina</option>
                                <option value="dzo" lang="dz">རྫོང་ཁ</option>
                                <option value="el" lang="el">Ελληνικά</option>
                                <option value="en_AU" lang="en">English (Australia)</option>
                                <option value="en_US" lang="en">English (USA)</option>
                                <option value="en_GB" lang="en">English (UK)</option>
                                <option value="en_CA" lang="en">English (Canada)</option>
                                <option value="en_ZA" lang="en">English (South Africa)</option>
                                <option value="en_NZ" lang="en">English (New Zealand)</option>
                                <option value="eo" lang="eo">Esperanto</option>
                                <option value="es_AR" lang="es">Español de Argentina</option>
                                <option value="es_EC" lang="es">Español de Ecuador</option>
                                <option value="es_MX" lang="es">Español de México</option>
                                <option value="es_ES" lang="es">Español</option>
                                <option value="es_VE" lang="es">Español de Venezuela</option>
                                <option value="es_CO" lang="es">Español de Colombia</option>
                                <option value="es_CR" lang="es">Español de Costa Rica</option>
                                <option value="es_PE" lang="es">Español de Perú</option>
                                <option value="es_PR" lang="es">Español de Puerto Rico</option>
                                <option value="es_UY" lang="es">Español de Uruguay</option>
                                <option value="es_GT" lang="es">Español de Guatemala</option>
                                <option value="es_CL" lang="es">Español de Chile</option>
                                <option value="es_DO" lang="es">Español de República Dominicana</option>
                                <option value="et" lang="et">Eesti</option>
                                <option value="eu" lang="eu">Euskara</option>
                                <option value="fa_IR" lang="fa">فارسی</option>
                                <option value="fa_AF" lang="fa">(فارسی (افغانستان</option>
                                <option value="fi" lang="fi">Suomi</option>
                                <option value="fr_FR" lang="fr">Français</option>
                                <option value="fr_BE" lang="fr">Français de Belgique</option>
                                <option value="fr_CA" lang="fr">Français du Canada</option>
                                <option value="fur" lang="fur">Friulian</option>
                                <option value="gd" lang="gd">Gàidhlig</option>
                                <option value="gl_ES" lang="gl">Galego</option>
                                <option value="gu" lang="gu">ગુજરાતી</option>
                                <option value="haz" lang="haz">هزاره گی</option>
                                <option value="he_IL" lang="he">עִבְרִית</option>
                                <option value="hi_IN" lang="hi">हिन्दी</option>
                                <option value="hr" lang="hr">Hrvatski</option>
                                <option value="hsb" lang="hsb">Hornjoserbšćina</option>
                                <option value="hu_HU" lang="hu">Magyar</option>
                                <option value="hy" lang="hy">Հայերեն</option>
                                <option value="id_ID" lang="id">Bahasa Indonesia</option>
                                <option value="is_IS" lang="is">Íslenska</option>
                                <option value="it_IT" lang="it">Italiano</option>
                                <option value="ja" lang="ja">日本語</option>
                                <option value="jv_ID" lang="jv">Basa Jawa</option>
                                <option value="ka_GE" lang="ka">ქართული</option>
                                <option value="kab" lang="kab">Taqbaylit</option>
                                <option value="kk" lang="kk">Қазақ тілі</option>
                                <option value="km" lang="km">ភាសាខ្មែរ</option>
                                <option value="kn" lang="kn">ಕನ್ನಡ</option>
                                <option value="ko_KR" lang="ko">한국어</option>
                                <option value="ckb" lang="ku">كوردی‎</option>
                                <option value="lo" lang="lo">ພາສາລາວ</option>
                                <option value="lt_LT" lang="lt">Lietuvių kalba</option>
                                <option value="lv" lang="lv">Latviešu valoda</option>
                                <option value="mk_MK" lang="mk">Македонски јазик</option>
                                <option value="ml_IN" lang="ml">മലയാളം</option>
                                <option value="mn" lang="mn">Монгол</option>
                                <option value="mr" lang="mr">मराठी</option>
                                <option value="ms_MY" lang="ms">Bahasa Melayu</option>
                                <option value="my_MM" lang="my">ဗမာစာ</option>
                                <option value="nb_NO" lang="nb">Norsk bokmål</option>
                                <option value="ne_NP" lang="ne">नेपाली</option>
                                <option value="nl_NL" lang="nl">Nederlands</option>
                                <option value="nl_BE" lang="nl">Nederlands (België)</option>
                                <option value="nl_NL_formal" lang="nl">Nederlands (Formeel)</option>
                                <option value="nn_NO" lang="nn">Norsk nynorsk</option>
                                <option value="oci" lang="oc">Occitan</option>
                                <option value="pa_IN" lang="pa">ਪੰਜਾਬੀ</option>
                                <option value="pl_PL" lang="pl">Polski</option>
                                <option value="ps" lang="ps">پښتو</option>
                                <option value="pt_BR" lang="pt">Português do Brasil</option>
                                <option value="pt_PT_ao90" lang="pt">Português (AO90)</option>
                                <option value="pt_AO" lang="pt">Português de Angola</option>
                                <option value="pt_PT" lang="pt">Português</option>
                                <option value="rhg" lang="rhg">Ruáinga</option>
                                <option value="ro_RO" lang="ro">Română</option>
                                <option value="ru_RU" lang="ru">Русский</option>
                                <option value="sah" lang="sah">Сахалыы</option>
                                <option value="snd" lang="sd">سنڌي</option>
                                <option value="si_LK" lang="si">සිංහල</option>
                                <option value="sk_SK" lang="sk">Slovenčina</option>
                                <option value="skr" lang="skr">سرائیکی</option>
                                <option value="sl_SI" lang="sl">Slovenščina</option>
                                <option value="sq" lang="sq">Shqip</option>
                                <option value="sr_RS" lang="sr">Српски језик</option>
                                <option value="sv_SE" lang="sv">Svenska</option>
                                <option value="sw" lang="sw">Kiswahili</option>
                                <option value="szl" lang="szl">Ślōnskŏ gŏdka</option>
                                <option value="ta_IN" lang="ta">தமிழ்</option>
                                <option value="ta_LK" lang="ta">தமிழ்</option>
                                <option value="te" lang="te">తెలుగు</option>
                                <option value="th" lang="th">ไทย</option>
                                <option value="tl" lang="tl">Tagalog</option>
                                <option value="tr_TR" lang="tr">Türkçe</option>
                                <option value="tt_RU" lang="tt">Татар теле</option>
                                <option value="tah" lang="ty">Reo Tahiti</option>
                                <option value="ug_CN" lang="ug">ئۇيغۇرچە</option>
                                <option value="uk" lang="uk">Українська</option>
                                <option value="ur" lang="ur">اردو</option>
                                <option value="uz_UZ" lang="uz">O‘zbekcha</option>
                                <option value="vi" lang="vi">Tiếng Việt</option>
                                <option value="zh_TW" lang="zh">繁體中文</option>
                                <option value="zh_HK" lang="zh">香港中文版	</option>
                                <option value="zh_CN" lang="zh">简体中文</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="direction">{{__('Direction')}}</label>
                            <select name="direction" class="form-control">
                                <option value="ltr">{{__('LTR')}}</option>
                                <option value="rtl">{{__("RTL")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_status">{{__('Status')}}</label>
                            <select name="status" class="form-control">
                                <option value="publish">{{__('Publish')}}</option>
                                <option value="draft">{{__("Draft")}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_slug">{{__('Slug')}}</label>
                            <input type="text" class="form-control" name="slug" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 @endcan

@endsection

@section('script')
    <script>
        (function($){
        "use strict";
        
        $(document).ready(function () {

            $(document).on('change', 'select[name="language_select"]', function () {
                var el = $(this);
               var name = el.parent().find('select[name="language_select"] option[value="'+el.val()+'"]' ).text()
                el.parent().find('input[name="name"]').val(name)
                el.parent().parent().find('input[name="slug"]').val(el.val())
            });

            $(document).on('click', '.lang_edit_btn', function () {
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var slug = el.data('slug');
                var form = $('#language_item_edit_modal');
                form.find('#lang_id').val(id);
                form.find('input[name="name"]').val(name);
                form.find('select[name="language_select"] option[value="'+slug+'"]').attr('selected',true);
                form.find('#edit_slug').val(slug);
                form.find('#edit_direction option[value="' + el.data('direction') + '"]').prop('selected', true);
                form.find('#edit_status option[value="' + el.data('status') + '"]').prop('selected', true);
            });

            $(document).on('click', '.lang_clone_btn', function () {
                var el = $(this);
                var id = el.data('id');
                var form = $('#language_item_clone_modal');
                form.find('input[name="id"]').val(id);
            });
        });
        })(jQuery);
    </script>
@endsection
