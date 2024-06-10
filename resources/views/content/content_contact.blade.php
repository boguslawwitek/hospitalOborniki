@extends('layouts.default')
@section('title')
- {{ $content->title }}
@endsection
@section('content')
    <div class="container-contact">
      <main class="main">
        <section class="section2">
            <h2>Formularz kontaktowy</h2>
            <form>
                <div>
                    <label for="name">Imię i nazwisko<span class="required">*</span></label>
                    <input type="text" id="name" name="name" maxlength="320" required autocomplete="off" />
                </div>
                <div>
                    <label for="email">Adres e-mail<span class="required">*</span></label>
                    <input type="email" id="email" name="email" maxlength="320" required autocomplete="off" />
                </div>
                <div>
                    <label for="phone-number">Telefon<span class="required">*</span></label>
                    <input type="tel" id="phone-number" maxlength="9" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" name="phone-number" required autoComplete="off" />
                </div>
                <div>
                    <label for="message">Wiadomość<span class="required">*</span></label>
                    <textarea class="message" maxlength="320" type="text" id="message" name="message" required autocomplete="off"></textarea>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="accept" name="accept" required autocomplete="off" />
                    <label for="accept">Wyrażam zgodę na przetwarzanie moich danych osobowych podanych w powyższym formularzu.<span class="required">*</span></label>
                </div>
                <div class="status-container">
                    <input type="submit" value="Wyślij">
                    <p class="status" :class="sendFormStatus.err ? 'error' : ''"></p>
                </div>
            </form>
        </section>
        <section class="section1">
            <h2>Kontakt</h2>
            <div>
                <div class="icon"><span class="material-symbols-outlined">pin_drop</span></div>
                <div>
                    <div class="title">Adres:</div>
                    <div class="desc">{{\App\Models\SystemSetting::getSettingValueByKey('hospital_address')}}</div>
                </div>
            </div>
            <div>
                <div class="icon"><span class="material-symbols-outlined">call</span></div>
                <div>
                    <div class="title">Telefon:</div>
                    <div class="desc">{{\App\Models\SystemSetting::getSettingValueByKey('contact_phone')}}</div>
                </div>
            </div>
            <div>
                <div class="icon"><span class="material-symbols-outlined">fax</span></div>
                <div>
                    <div class="title">Fax:</div>
                    <div class="desc">{{\App\Models\SystemSetting::getSettingValueByKey('fax')}}</div>
                </div>
            </div>
            <div>
                <div class="icon"><span class="material-symbols-outlined">mail</span></div>
                <div>
                    <div class="title">E-Mail:</div>
                    <div class="desc">{{\App\Models\SystemSetting::getSettingValueByKey('system_mail')}}</div>
                </div>
            </div>
        </section>
      </main>
    </div>
@endsection
