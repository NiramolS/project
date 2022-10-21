@extends('layouts.main')

@section('title', $title)

@section('content')

<main>

    <div class="img-index">
        <img src="{{ asset('images/index/' . 'main.png') }}" alt="index" style="width: 95%; display:block; margin:0 auto;">
    </div>

    {{-- order now button --}}

    <nav class="topic-index">
        <h2>| History of Ban Don Luang cotton Weaving Community</h2>
        <table>
            <tr>
                <td class="img-his" style="width:40%;">
                    <center><img src="{{ asset('images/index/' . 'history.png') }}" alt="index" style="width: 60%; "></center>
                </td>
                <td class="his-lo" style="width: 40%;">
                    <p>
                        A major source of hand-woven cotton handicrafts produced and sold domestically and export to overseas countries.
                        Ban Don Luang weaving village has created income and employment for the villagers and their community.
                        In the past, women did weaving for household use. Later, it become more well-known.
                        It has developed colorful and modern patterns. As a result, the handicraft products have such various items
                        available such as clothes, shawls, pillowcases, curtains, and tablecloths.</p>
                </td>
            </tr>
        </table>
        <br>
        <hr align="center" width="100%">
        <br>
        <h2>| Location</h2>
        <p class="his-lo">Mae Raeng Sub-district, Pa Sang District, Lamphun Province</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30269.65600124552!2d98.89266311586604!3d18.496926434858235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30dbc959fccf4429%3A0x40346c5fa8b9910!2sMae%20Raeng%2C%20Pa%20Sang%20District%2C%20Lamphun%2051120!5e0!3m2!1sen!2sth!4v1666158037547!5m2!1sen!2sth" 
            width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        <p></p>
    </nav>
</main>


@endsection