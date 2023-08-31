<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;

class NationnalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Tableau des nationalités en français
        $nationalites = [
'Afghan', 'Albanais', 'Algérien', 'Allemand', 'Américain', 'Andorran', 'Angolais', 'Antiguais', 'Argentin', 'Arménien', 'Australien', 'Autrichien', 'Azerbaïdjanais', 'Bahaméen', 'Bahreïnien', 'Bangladais', 'Barbadien', 'Belarusse', 'Belge', 'Bélizien', 'Béninois', 'Bhoutanais', 'Bolivien', 'Bosniaque', 'Botswanais', 'Brésilien', 'Britannique', 'Bruneien', 'Bulgare', 'Burkinabè', 'Burundais', 'Cambodgien', 'Camerounais', 'Canadien', 'Capverdien', 'Centrafricain', 'Chilien', 'Chinois', 'Chypriote', 'Colombien', 'Comorien', 'Congolais', 'Coréen', 'Costaricain', 'Croate', 'Cubain', 'Danois', 'Djiboutien', 'Dominicain', 'Égyptien', 'Émirien', 'Équatorien', 'Érythréen', 'Espagnol', 'Estonien', 'Éthiopien', 'Fidjien', 'Finlandais', 'Français', 'Gabonais', 'Gambien', 'Géorgien', 'Ghanéen', 'Grec', 'Grenadien', 'Guatémaltèque', 'Guinéen', 'Guyanais', 'Haïtien', 'Hondurien', 'Hongrois', 'Indien', 'Indonésien', 'Irakien', 'Iranien', 'Irlandais', 'Islandais', 'Israélien', 'Italien', 'Ivoirien', 'Jamaïcain', 'Japonais', 'Jordanien', 'Kazakh', 'Kenyan', 'Kirghize', 'Kiribatien', 'Koweïtien', 'Laotien', 'Lesothan', 'Letton', 'Libanais', 'Libérien', 'Libyen', 'Liechtensteinois', 'Lituanien', 'Luxembourgeois', 'Macédonien', 'Malagasy', 'Malaisien', 'Malawite', 'Maldivien', 'Malien', 'Maltais', 'Marocain', 'Marshallais', 'Mauricien', 'Mauritanien', 'Mexicain', 'Micronésien', 'Moldave', 'Monégasque', 'Mongol', 'Monténégrin', 'Mozambicain', 'Namibien', 'Nauruan', 'Néerlandais', 'Néo-Zélandais', 'Népalais', 'Nicaraguayen', 'Nigérian', 'Nigérien', 'Nord-Coréen', 'Norvégien', 'Omanais', 'Ougandais', 'Ouzbek', 'Pakistanais', 'Palauan', 'Palestinien', 'Panaméen', 'Papouanéoguinéen', 'Paraguayen', 'Péruvien', 'Philippin', 'Polonais', 'Portugais', 'Qatari', 'Roumain', 'Russe', 'Rwandais', 'Saint-Lucien', 'Saint-Marinais', 'Saint-Vincentais', 'Salomonais', 'Salvadorien', 'Samoan', 'São Toméen', 'Saoudien', 'Sénégalais', 'Serbe', 'Seychellois', 'Sierra-Léonais', 'Singapourien', 'Slovaque', 'Slovène', 'Somalien', 'Soudanais', 'Sri-Lankais', 'Sud-Africain', 'Sud-Coréen', 'Sud-Soudanais', 'Suédois', 'Suisse', 'Surinamien', 'Swazi', 'Syrien', 'Tadjik', 'Taïwanais', 'Tanzanien', 'Tchadien', 'Tchèque', 'Thaïlandais', 'Timorais', 'Togolais', 'Tonguien', 'Trinidadien', 'Tunisien',
'Turkmène', 'Turc', 'Tuvaluan', 'Ukrainien', 'Uruguayen', 'Vanuatuan', 'Vénézuélien', 'Vietnamien', 'Yéménite', 'Zambien', 'Zimbabwéen',
            // Ajoutez les autres nationalités ici...
        ];

        // Parcours du tableau des nationalités
        foreach ($nationalites as $nationalite) {
            // Création d'un nouvel objet Nationalite
            $n = new Nationality();
            $n->name = $nationalite;

            // Enregistrement de la nationalité dans la base de données
            $n->save();
        }
    }
}
