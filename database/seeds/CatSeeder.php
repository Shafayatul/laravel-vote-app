<?php

use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cats')->delete();
        \DB::table('cats')->insert(array(

          0 => array (
            'name' => "Braut- & Herrenmode | Bester Brautkleidsalon",
            'code' => "bester-brautkleidsalon",
            'count' => "5",
            'text' => "Max. 5 Fotos, die das Geschäftslokal zeigen (inklusive Kabine und anderen Bereichen, die für ein professionelles und angenehmes Ambiente sorgen). Bitte achten Sie darauf, etwaige Logos zu entfernen.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter - des Geschäftes (Angaben zur Kabinenanzahl, Modellauswahl, Geschäftsgröße,…) und der herausragenden Serviceleistungen (z.B. Möglichkeiten der Terminvereinbarung, Getränkeangebot, Priveé-Termine möglich, Sonderleistungen wie Lieferservice, Änderungsservice,…)",
            'words' => "300",
            'extra' => "",
            'group' => "1",
            'referenz' => "Zwei öffentliche Referenzen von realen Bräuten mit Verlinkung (z.B. Facebook, Google,…)",
            'hints' => "Max. 5 Fotos"
          ),

          1 => array (
            'name' =>	"Braut- & Herrenmode | Bestes Brautkleiddesign",
            'code' => "bestes-brautkleiddessign",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos, die das Geschäftslokal zeigen (inklusive Kabine und anderen Bereichen, die für ein professionelles und angenehmes Ambiente sorgen). Bitte achten Sie darauf, etwaige Logos zu entfernen.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter - des Designers (Laufbahn, Ausbildung, Inspirationsquellen,…) und des außergewöhnlichen Designs bzw. der Idee dahinter.",
            'words' => "300",
            'extra' => "",
            'group' => "1",
            'referenz' => "Zwei öffentliche Referenzen von realen Bräutigamen mit Verlinkung (z.B. Facebook, Google,…)"
          ),

          2 => array (
            'name' =>	"Braut- & Herrenmode | Bester Herrenausstatter",
            'code' => "bester-herrenausstatter",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos EINES Brautkleides, designed 2018",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter - des Geschäftes (z.B. Auswahl, Kabinenanzahl,… und der herausragenden Serviceleistungen (z.B. Möglichkeiten der Terminvereinbarung, Änderungsservice, Angebot von Accessoires,…)",
            'words' => "300",
            'extra' => "",
            'group' => "1",
            'referenz' => ""

          ),

          3 => array (
            'name' =>	"Brautstyling",
            'code' => "brautstyling",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos, die das Styling einer realen Braut mit Detailaufnahmen zeigen.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter - wie das Styling auf das Gesamtkonzept der Hochzeit, das Brautkleid und die Braut abgestimmt wurde.",
            'words' => "300",
            'extra' => "",
            'referenz' => "",
            'group' => "2"
          ),
          4 => array (
            'name' =>	"Catering | Gesamtkonzept",
            'code' => "catering-gesamtkonzept",
            'count' => "8",
            'hints' => "max. 8 Fotos",
            'text' => "Max. 8 Fotos, die das originelle Cateringangebot zeigen.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter - des Cateringkonzept (z.B. innovatives Speisen- & Getränkeangebot, Art der Präsentation, besondere Kleidung der Servicekräfte, Geschirr & Equipment,…)",
            'words' => "300",
            'extra' => "",
            'group' => "3",
            'referenz' => "2 Referenzen von Brautpaaren und/oder Hochzeitsplanern"
          ),
          5 => array (
            'name' =>	"Entertainment | DJ",
            'code' => "dj",
            'count' => "3",
            'hints' => "max. 3 Fotos",
            'text' => "Max. 3 Fotos der Performance",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter der Besonderheit des besonderen Service/Leistung (z.B. Licht, verwendete Technologie, weitere Ideen,…) sowie ein Videomitschnitt von max. 2 Minuten, die die Qualität der Performance bei einer oder mehreren Hochzeiten zeigt (Handyvideo ist ausreichend; auch ein Zusammenschnitt aus mehrerer Sequenzen ist möglich) ",
            'words' => "300",
            'extra' => "",
            'group' => "4",
            'referenz' => "Eine Referenz von einem Brautpaar oder einem Hochzeitsplaner"
          ),
          6 => array (
            'name' =>	"Entertainment | Kinderanimation",
            'code' => "kinderanimation",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos, die den Einsatz bei einer Hochzeit & das Besondere der Kinderbetreuung darstellen.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter der Besonderheit des Services (z.B. Babysitterserivce, Kinderdisco, Karaoke Show,…)",
            'words' => "300",
            'extra' => "",
            'group' => "4",
            'referenz' => "Eine Referenz von einem Brautpaar oder einem Hochzeitsplaner"
          ),
          7 => array (
            'name' =>	"Entertainment | Live-Musik Abend",
            'code' => "live-musik-abend",
            'count' => "3",
            'hints' => "max. 3 Fotos",
            'text' => "Max. 3 Fotos der Performance",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter der Performance, der Besonderheit und der Musiker(-Gruppe) sowie ein Videomitschnitt von max. 2 Minuten, die die Qualität der Performance bei einer oder mehreren Hochzeiten zeigt (Handyvideo ist ausreichend; auch ein Zusammenschnitt aus mehrerer Sequenzen ist möglich) ",
            'words' => "300",
            'extra' => "",
            'group' => "4",
            'referenz' => "Eine Referenz von einem Brautpaar oder einem Hochzeitsplaner"
          ),
          8 => array(
            'name' =>	"Entertainment | Live-Musik Trauung",
            'code' => "live-musik-trauung",
            'count' => "3",
            'hints' => "max. 3 Fotos",
            'text' => "Max. 3 Fotos der Performance",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter der Performance, der Besonderheit und der Musiker(-Gruppe) sowie ein Videomitschnitt von max. 2 Minuten, die die Qualität der Performance bei einer oder mehreren Hochzeiten zeigt (Handyvideo ist ausreichend; auch ein Zusammenschnitt aus mehrerer Sequenzen ist möglich) ",
            'words' => "300",
            'extra' => "",
            'group' => "4",
            'referenz' => "Eine Referenz von einem Brautpaar oder einem Hochzeitsplaner"
          ),
          9 => array (
            'name' =>	"Entertainment | Show-Act",
            'code' => "show-act",
            'count' => "3",
            'hints' => "max. 3 Fotos",
            'text' => "Max. 3 Fotos der Performance",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter der Besonderheit des Show-Acts sowie ein Videomitschnitt von max. 2 Minuten, die die Qualität der Performance bei einer oder mehreren Hochzeiten zeigt (Handyvideo ist ausreichend; auch ein Zusammenschnitt aus mehrerer Sequenzen ist möglich) ",
            'words' => "300",
            'extra' => "",
            'group' => "4",
            'referenz' => "Eine Referenz von einem Brautpaar oder einem Hochzeitsplaner"
          ),

          10 => array (
            'name' =>	"Floristik | Brautstrauss",
            'code' => "brautstrauss",
            'count' => "3",
            'hints' => "max. 3 Fotos",
            'text' => "Max. 3 Fotos eines Brautstraußes",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "Beschreibung: max. 50 Wörter zum Gesamtkonzept (Thema, Motto, Highlights)",
            'words' => "50",
            'extra' => "",
            'group' => "5",
            'referenz' => ""
          ),
          11 => array (
            'name' =>	"Floristik | Gesamtkonzept",
            'code' => "floristik-gesamtkonzept",
            'count' =>"8",
            'hints' => "max. 8 Fotos",
            'text' => "Max. 8 Fotos, die die gesamte Blumendekoration zeigen.",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "Beschreibung: max. 50 Wörter zum Gesamtkonzept (Thema, Motto, Highlights)",
            'words' => "50",
            'extra' => "",
            'group' => "5",
            'referenz' => ""
          ),
          12 => array (
            'name' =>	"Fotografie | Brautpaarportrait",
            'code' => "brautpaarportrait",
            'count' => "1",
            'hints' => "max. 1 Foto",
            'text' => "Max. 1 Foto einer Braut oder Bräutigams",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "",
            'words' => "0",
            'extra' => "",
            'group' => "6",
            'referenz' => ""
          ),
          13 => array (
            'name' =>	"Fotografie | Detailaufnahmen",
            'code' => "detailaufnahmen",
            'count' => "1",
            'hints' => "max. 1 Foto",
            'text' => "Max. 1 Foto einer Detailaufnahme",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "",
            'words' => "0",
            'extra' => "",
            'group' => "6",
            'referenz' => ""
          ),
          14 => array (
            'name' =>	"Fotografie | Engagement Shooting",
            'code' => "engagement-shooting",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos eines Engagement Shootings (Antrag, Verlobung, Paarshooting)",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "",
            'words' => "0",
            'extra' => "",
            'group' => "6",
            'referenz' => ""
          ),
          15 => array (
            'name' =>	"Fotografie | Hochzeitsreportage",
            'code' => "hochzeitsreportage",
            'count' => "15s",
            'hints' => "max 15 Fotos",
            'text' => "Max. 15 Fotos die die Geschichte des Hochzeitstages erzählen!",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "",
            'words' => "0",
            'extra' => "",
            'group' => "6",
            'referenz' => ""
          ),
          16 => array (
            'name' =>	"Fotografie | Momentaufnahme",
            'code' => "momentaufnahme",
            'count' => "1",
            'hints' => "max. 1 Foto",
            'text' => "Max. 1 Foto einer Momentaufnahme",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "",
            'words' => "0",
            'extra' => "",
            'group' => "6",
            'referenz' => ""
          ),
          17 => array (
            'name' =>	"Fotografie | Soloportrait",
            'code' => "soloportrait",
            'count' => "1",
            'hints' => "max. 1 Foto",
            'text' => "Max. 1 Foto eines Soloportraits",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "",
            'words' => "0",
            'extra' => "",
            'group' => "6",
            'referenz' => ""
          ),
          18 => array (
            'name' =>	"Freie Trauung",
            'code' => "freie-trauung",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos einer realen Hochzeit, die den Hochzeitsredner in Aktion abbilden.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 500 Wörter des detaillierten Ablaufs und Aufbau der Zeremonie, inkl. Beschreibung der Highlights/Besonderheit der Trauung",
            'words' => "500",
            'extra' => "",
            'group' => "6",
            'referenz' => "Eine Referenz des Brautpaares inkl. Kontaktinformation (max. 300 Wörter)"
          ),
          19 => array (
            'name' =>	"Hochzeitsplanung",
            'code' => "hochzeitsplanung",
            'count' => "15",
            'hints' => "max. 15 Fotos",
            'text' => "Max. 15 Fotos die die Besonderheiten der umgesetzten Ideen einer realen Gesamtorganisation zeigen.",
            'ort' => "",
            'group' => "7",
            'beschreibung' => "Beschreibung: max. 500 Wörter des stimmigen Konzepts, wie die Wünsche und Vorstellungen des Brautpaares umgesetzt werden konnten",
            'words' => "500",
            'extra' => "Weitere Informationen zur Location, Gästeanzahl, Gesamtbudget, grober Tagesablauf (wird nicht veröffentlicht!) - TÜV Zertifizierung vorhanden?",
            'referenz' => "Eine Referenz des Brautpaares inkl. Kontaktinformation (max. 300 Wörter) sowie zweier mitwirkender Dienstleister/Kooperationspartner (max. je 150 Wörter)."
          ),
          20 => array (
            'name' =>	"Innovation",
            'code' => "innovation",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos der bereits umgesetzten Innovation/Idee.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter zum Projekt und des Nutzens für die Hochzeitsbranche.",
            'words' => "300",
            'extra' => "",
            'group' => "8",
            'referenz' => ""
          ),
          21 => array (
            'name' =>	"Location | Dinner & Tanz",
            'code' => "dinner-tanz",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos, die die Einzigartigkeit oder Schönheit des Festsaals hervorheben. Die Fotos sollten den Saal leer und/oder in einem Hochzeitssetting zeigen. Die Bilder können von mehreren Hochzeiten sein und/oder die verschiedenen Räume innerhalb einer Location präsentieren.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter dessen, was den Raum/Räume von anderen unterscheidet (einzigartige Umgebung, angebotenen Dienstleistungen, etc.).",
            'words' => "300",
            'extra' => "",
            'group' => "9",
            'referenz' => ""
          ),
          22 => array (
            'name' =>	"Location | Trauung",
            'code' => "trauung",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos, die die Vielseitigkeit, Einzigartigkeit und Schönheit einer Location für die Zeremonie zeigen. Die Fotos können mehrere Hochzeitszeremonien und/oder Räume zeigen.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter dessen, was die Location von anderen unterscheidet (einzigartige Umgebung, angebotenen Leistungen etc.).",
            'words' => "300",
            'extra' => "",
            'group' => "9",
            'referenz' => ""
          ),
          23 => array (
            'name' =>	"Papeterie | Gesamtkonzept",
            'code' => "papeterie-gesamtkonzept",
            'count' => "8",
            'hints' => "max. 8 Fotos",
            'text' => "Max. 8 Fotos, die ein zusammengehöriges Set von Drucksorten, sowie Detailaufnahmen besonderer Highlights zeigen.",
            'ort' => "",
            'beschreibung' => "Informationen zum verwendeten Material und Druckverfahren (max. 150 Wörter).",
            'words' => "150",
            'extra' => "",
            'group' => "10",
            'referenz' => ""
          ),
          24 => array (
            'name' =>	"Schmuckdesign | Ringe",
            'code' => "ringe",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos eines designten Eheringes. Die Fotos können die Ringe an einem Brautpaar oder für sich alleine zeigen.",
            'ort' => "",
            'beschreibung' => "Informationen zum verwendeten Material und Besonderheiten des Schmuckstückes (max. 150 Wörter)",
            'words' => "150",
            'extra' => "",
            'group' => "11",
            'referenz' => ""
          ),
          25 => array (
            'name' =>	"Styled Shoot Team",
            'code' => "styled-shoot-team",
            'count' => "8",
            'hints' => "max. 8 Fotos",
            'text' => "Max. 8 Fotos eines Styled Shoots; Fotos sollten eine Reihe von detaillierten Aufnahmen des Styled Shoots enthalten",
            'ort' => "",
            'beschreibung' => "Informationen über mitwirkende Dienstleister (Firmenname) - max. 300 Wörter",
            'words' => "300",
            'extra' => "",
            'group' => "12",
            'referenz' => ""
          ),
          26 => array (
            'name' =>	"Tortendesigner | Sweet Table",
            'code' => "sweet-table",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos einer Hochzeitstorte, die die gesamte Torte, sowie deren Details zeigen.",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "",
            'words' => "0",
            'extra' => "",
            'group' => "13",
            'referenz' => ""
          ),
          27 => array (
            'name' =>	"Tortendesigner | Hochzeitstorten-Design",
            'code' => "hochzeitstorten-designer",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos eines gesamten Sweet Tables, sowie Detailfotos der einzelnen Elemente.",
            'ort' => "Ort und Datum der Hochzeit",
            'beschreibung' => "",
            'words' => "",
            'extra' => "",
            'group' => "13",
            'referenz' => ""
          ),
          28 => array (
            'name' =>	"Video | Highlight Video",
            'code' => "highlight-video",
            'count' => "1",
            'hints' => "max. 1 Foto",
            'text' => "Max. 1 Foto welches ein Screenshot vom Video zeigt!",
            'ort' => "",
            'beschreibung' => "Informationen zur Musiklizenz",
            'words' => "",
            'extra' => "",
            'group' => "14",
            'referenz' => ""
          ),
          29 => array (
            'name' =>	"Weddingdesigner | Gesamtkonzept",
            'code' => "weddingdesigner-gesamtkonzept",
            'count' => "15",
            'hints' => "max. 15 Fotos",
            'text' => "Max. 15 Fotos, die den Gesamteindruck, sowie Detailaufnahmen der Hochzeit zeigen.",
            'ort' => "",
            'beschreibung' => "Beschreibung: max. 300 Wörter zum Weddingdesign (z.B. Raumgestaltung (Licht, Möbel), Drucksorten, Trauungs-Set-Up, Floristik, Brautkleid, Catering…).",
            'words' => "300",
            'extra' => "",
            'group' => "15",
            'referenz' => "Eine Referenz des Brautpaares inkl. Kontaktinformation (max. 300 Wörter)"
          ),
          30 => array (
            'name' => "!!! Bitte Kategorie auswählen",
            'code' => "!!! Bitte Kategorie auswählen",
            'count' => "",
            'hints' => "",
            'text' => "",
            'ort' => "",
            'beschreibung' => "",
            'words' => "",
            'extra' => "",
            'group' => "0",
            'referenz' => ""
          ),

          31 => array (
            'name' => "Papeterie | Einladung",
            'code'=> "papeterie-einladung",
            'count' => "5",
            'hints' => "max. 5 Fotos",
            'text' => "Max. 5 Fotos, die die Einladung mit Details, sowie besonderen Highlights zeigen.",
            'ort' => "",
            'beschreibung' => "Informationen zum verwendeten Material und Druckverfahren (max. 150 Wörter).",
            'words' => "150",
            'extra' => "",
            'group' => "10",
            'referenz' => ""
          )


        ));

    }

  }
