<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Londonist Example Form</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <!-- Styles -->
    <style>
        :root {
            /** FONTS **/
            --font-family: "Montserrat", sans-serif;
            /** CUSTOM COLORS **/

            --bg-custom: #423E93;
            --white: #fff;
            --gray: #ccc;
        }

        html,
        body {
            padding: 0;
            margin: 0;
            height: 100%;
            font-family: var(--font-family);
        }

        #container {
            background: url("{{ asset('images/bg.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .contact-form-container {
            background: rgba(255, 255, 255, 0.6);
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--bg-custom);
            font-weight: bold;
        }

        .bg-custom {
            background: var(--bg-custom);
            color: var(--white);
        }

        .footer-section {
            background: var(--gray);
        }
    </style>
</head>

<body>
    @if (session('message'))
        <div class="row mb-2 container mx-auto alert-dismissible fade show">
            <div class="col-lg-12">
                <div class="alert alert-success" role="alert">{{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="row mb-2 container mx-auto alert-dismissible fade show">
            <div class="col-lg-12">
                <div class="alert alert-danger" role="alert">{{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    <div class="header-section container mx-auto">
        <div class="row p-3">
            <div class="col-6">
                <img src="{{ asset('images/Group 9806.svg') }}" alt="">
            </div>
            <div class="col-6 text-right">
                <img src="{{ asset('images/Group 9804.svg') }}" alt="">
            </div>
        </div>
    </div>

    <div class="page-container p-0 m-0  w-100" id="container">
        <div class="row">
            <div class="col-md-7 col-sm-12">

            </div>
            <div class="col-md-4 col-sm-12">
                <div class="contact-form-container w-75 p-3 rounded my-5">
                    <div class="form-group">
                        <h4 class="text-center">
                            İstanbul’da Özel Gayrimenkul Organizasyonuna Katılmak için Kayıt Yapın!
                        </h4>
                    </div>
                    <form method="POST" action="{{ route('frontend.contacts.storepublic') }}"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="First Name*" name="first_name"
                                id="first_name" value="{{ old('first_name', '') }}" required>
                            @if ($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Last Name*" name="last_name"
                                id="last_name" value="{{ old('last_name', '') }}" required>
                            @if ($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            @php
                                $cList = $countries;
                            @endphp
                            <select class="form-control" name="country_id" id="country_id" required>
                                <option value disabled {{ old('country_id', null) === null ? 'selected' : '' }}>Country
                                    of Residence*
                                </option>
                                @foreach ($cList as $key => $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="d-flex align-items-center">
                                <select class="form-control mr-1" style="width: 100px" name="country_code"
                                    id="country_code" required>
                                    <option value="+90">🇹🇷 +90</option>
                                    <option value="+44">🇬🇧 +44</option>
                                    <option value="+1">🇺🇸 +1</option>
                                </select>
                                <input class="form-control" placeholder="Phone*" type="text" name="phone"
                                    id="phone" value="{{ old('phone', '') }}" required>
                            </div>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input class="form-control datetime" placeholder="Meeting Date*" type="text"
                                name="meeting_date" id="meeting_date" value="{{ old('meeting_date') }}" required>
                            @if ($errors->has('meeting_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meeting_date') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">

                            <select class="form-control" name="budget" id="budget" required>
                                <option value disabled {{ old('budget', null) === null ? 'selected' : '' }}>Budget*
                                </option>
                                @foreach (App\Models\Contact::BUDGET_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('budget', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('budget'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('budget') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="number_of_bedrooms" id="number_of_bedrooms" required>
                                <option value disabled
                                    {{ old('number_of_bedrooms', null) === null ? 'selected' : '' }}>Number of
                                    Bedrooms*</option>
                                @foreach (App\Models\Contact::NUMBER_OF_BEDROOMS_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('number_of_bedrooms', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('number_of_bedrooms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_of_bedrooms') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block bg-custom" type="submit">
                                {{ trans('global.submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="second-page w-50 mx-auto p-3">
        <h2 class="py-3">ÇOK ÖNEMLİ BİR ETKİNLİĞE DAVETLİSİNİZ!</h2>
        <table class="table">

            <tbody>
                <tr>

                    <td><b>ORGANIZASYON ADI </b></td>
                    <td><b>:</b> BERKELEY GROUP COLLECTION ISTANBUL</td>
                </tr>
                <tr>


                    <td><b>TARİH </b></td>
                    <td><b>:</b> 16-17 ŞUBAT 2024</td>
                </tr>
                <tr>


                    <td><b>Yer </b></td>
                    <td><b>:</b> MANDARIN ORIENTAL BOSPHORUS, İSTANBUL, TÜRKIYE</td>
                </tr>
            </tbody>

        </table>
        <div>
            <p>
                Londra’nın en popüler mahallelerinde bulunan lüks emlak portföyümüzü İstanbul’da sergiliyoruz. Sizi,
                16-17 Şubat 2024 tarihlerinde düzenlenecek olan etkinliğe Londonist Investments tarafından davetlisiniz!
            </p>
            <p>
                Orta Doğu, Afrika, Hindistan ve Londra’daki kıdemli satış ekibimize katılın!Birlikte, Berkeley Group’un
                Londra’nın merkezi ve ötesindeki lüks geliştirme portföyünü sunacak ve misafirlerle birebir toplantılara
                ev sahipliği yapacağız.
            </p>
            <p>
                Bunların yanı sıra iş birliği içerisinde bulunduğumuz iç mimar, Mortgage danışmanı ve avukatlar ile
                organizasyon sırasında görüşme imkanı bulabileceksiniz! Londra’da yatırım yapmak hakkında bilmeniz
                gereken her şey için buradayız!
            </p>
        </div>
    </div>

    <div class="footer-section text-center p-3">
        <div class="row container mx-auto">
            <div class="col-md-3">
                <img src="{{ asset('images/Group 9809.svg') }}" alt="">
            </div>
            <div class="col-md-6">
                <p><b>On Social Media Follow Us!</b></p>
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <img class="mx-2" src="{{ asset('images/facebook.png') }}" alt="">
                    <img class="mx-2" src="{{ asset('images/youtube.png') }}" alt="">
                    <img class="mx-2" src="{{ asset('images/twitter.png') }}" alt="">
                    <img class="mx-2" src="{{ asset('images/linkedin.png') }}" alt="">
                    <img class="mx-2" src="{{ asset('images/instagram.png') }}" alt="">

                </div>
                <p>Copyright © 2024 londonistinvestments.com</p>
            </div>
            <div class="col-md-3">
                <img src="{{ asset('images/Group 9808.svg') }}" alt="">
            </div>
        </div>
    </div>

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>
<script src="{{ asset('js/main.js') }}"></script>
