<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <style>

    @page { margin: 100px 25px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 70px; text-align: center;}
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }


    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }
    thead{

    }
    .right-text{
        text-align: left;
        display: block;
        overflow: hidden;
    }
    .block{
        display: block;
        overflow: hidden;
        text-align: right;
    }
    </style>

    <footer>
        Mag. Bianca Lehrner
        <br>
        Himmelpfortgasse 20 – 1010 Wien | Tel. 0650 58 00 550 | ATU 65103933
        <br>
        office@austrianweddingaward.at - www.austrianweddingaward.at        
    </footer>
    <main>
        <div class="block">
            <br>
            <img src="logo_sml.jpg">
            <br>
            Wien, {{$date}}
            <br>
            @if($invoice->id < 10)
                AWA-{{$year}}-00{{$invoice->id}}
            @elseif($invoice->id < 100)
                AWA-{{$year}}-0{{$invoice->id}}
            @else
                AWA-{{$year}}-{{$invoice->id}}
            @endif

            
            <br>
            <br>
        </div>

        <div class="right-text">
            {{$user->firma}}<br>
            {{$user->atu}}<br>
            {{$user->titel}}<br>
            {{$user->vorname}}<br>
            {{$user->adresse}}<br>
            {{$user->ort}}<br>
        </div>

        <br>
        <br>
        <br>     

        <div>
            Vielen Dank für Ihre Teilnahme am Austrian Wedding Award. Wir freuen uns sehr, dass Sie Ihre kreativen Beiträge eingereicht haben und wünschen Ihnen schon jetzt viel Erfolg beim
            Austria Wedding Award 2019.
        </div>

        <br>
        <br>
        <br>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Description</th>
                    <th>Group</th>
                    <th>VAT</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $group_array = [];
                    $netto = 0;
                    $first_project = true;
                @endphp
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$project->beschreibung}}</td>
                        <td>{{$project->group}}</td>
                        <td>20%</td>
                        <td>
                            @php
                                if(in_array($project->group, $group_array)){
                                    $price = 36;
                                }elseif($first_project){
                                    $price = 96;
                                    array_push($group_array, $project->group);
                                    $first_project = false;
                                }else{
                                    $price = 55;
                                    array_push($group_array, $project->group);
                                }
                                $netto = $netto+$price;
                            @endphp
                            {{$price}}
                        </td>
                    </tr>           
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Netto</td>
                    <td>
                        {{$netto}}
                    </td>
                </tr> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Ust 20%</td>
                    <td>
                        {{$netto*.20}}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Gesamt</td>
                    <td>
                        {{$netto+($netto*.20)}}
                    </td>
                </tr>
            </tbody>
        </table> 
        <br>
        <div>
            Wir ersuchen Sie um Überweisung des Gesamtbetrags innerhalb von 7 Tagen auf unser Konto bei der Ersten Bank: <b>AT60 2011 1292 4654 2804</b>
        </div>       
        <br>
        <br>
        Herzliche Grüße
        <br>
        Susanne Hummel & Bianca Lehrner
    </main>


</body>
</html>