<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Impression de l'attestation</title>
  <style>
    .container {
        padding: 5px;
        margin: 15px;
        border: 1px solid black;
        height: 900px;
        width: 794px;
    }
    header{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px;
    }
    header div{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 10px;
    }
    main{
        padding: 10px;
    }
    main div{
        text-align: justify;
        line-height: 1.5; 
        font-family: sans-serif;
        padding: 10px;
    }
    header div img {
        height: 90px;
        margin: 0 10px;
    }
    footer{
        display: flex;
        align-content: flex-end;
        justify-content: flex-end;
        flex-direction: column;
        text-align: right;
        margin-top: 100px;
        margin-right: 200px;
        padding: 10px;
    }
    h3{
        width: 600px;
        margin: auto;
        text-align: center !important;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        padding-bottom: 10px;
        border-bottom: 1px solid black;
        border-height: 10px;
        margin-bottom: 20px;
    }
    button {
        display: block;
        position: relative;
        bottom: 900px;
        right: 330px;
        border: none;
        padding: 10px 20px;
        background-color: rgb(25, 8, 122);
        color: white;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-weight: 700;
        float: right;
    }
    @media print {
        /* Cacher tous les éléments de la page, sauf le contenu de l'attestation */
        body * {
          visibility: hidden;
        }
        .container {
        padding: 0;
        margin: 0;
        border: none;
        height: 100%;
        width: 100%;
        visibility: visible;
    }
    header{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px;
        color: black;
        visibility: visible;    
    }
    header div{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 10px;
        color: black;
        visibility: visible;
    }
    header div span{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 10px;
        color: black;
        visibility: visible;
    }
    header p{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 10px;
        color: black;
        visibility: visible;
    }
    main{
        padding: 10px;
        visibility: visible;
    }
    main div{
        text-align: justify;
        line-height: 1.5; 
        font-family: sans-serif;
        padding: 10px;
        visibility: visible;
    }
    header div img {
        height: 90px;
        margin: 0 10px;
        visibility: visible;
    }
    footer div span{
        display: flex;
        align-content: flex-end;
        justify-content: flex-end;
        flex-direction: column;
        text-align: right;
        padding: 10px;
        color: black;
        visibility: visible;
    }
    h3{
        width: 600px;
        margin: auto;
        text-align: center !important;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        padding-bottom: 10px;
        border-bottom: 1px solid black;
        border-height: 10px;
        margin-bottom: 20px;
        visibility: visible;
    }
        
    }
  </style>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <span>Republique demoncratique
                     <br> du congo                   
                </span>
                <span><img src="https://th.bing.com/th/id/OIP.cOqrYW_krqrnUmtEoipi3gHaIS?pid=ImgDet&rs=1" alt="Logo"></span>
                <span>Ville de kinshasa 
                    <br> Commune de Kalamu 
                    <br> Service de la population
                </span>        
            </div>
            <p>{{ $attestation->dateREM }}</p>
        </header>
        <h3>Attestation de Droit de propriété N° {{ $attestation->id }}/sp/fc/klm/2023</h3>
        <main>
            <div>
                Je soussigné,{{ $attestation->user->name }}, {{ $attestation->user->postnom }},
                {{ $attestation->user->prenom }}, Bourgmettre de la commune de kalamu, atteste par
                  la parcelle sise sur l'avenue {{ $attestation->parcelle->avenue }}, N° {{ $attestation->parcelle->id }} Bis , Quartier
                  {{ $attestation->parcelle->quartier }}, commune  {{ $attestation->parcelle->commune }} , dans ma juridiction est devenue la propriété de {{ $attestation->parcelle->proprietaire->nom }},
                  {{ $attestation->parcelle->proprietaire->postnom }}, {{ $attestation->parcelle->proprietaire->prenom }}, Résidant à kinshasa sur l'avenue {{ $attestation->parcelle->proprietaire->avenue }}, N° {{ $attestation->parcelle->proprietaire->numeroPar }} Bis,
                     dans le quartier {{ $attestation->parcelle->proprietaire->quartier }}, commune de  {{ $attestation->parcelle->proprietaire->commune }}.
                Suivant le document ci-après en sa possession : l'attestation de confirmation 
                parcellaire n° {{ $attestation->parcelle->numACP }} du {{ $attestation->parcelle->proprietaire->DateACP }}, en foi de quoi, la présente attestation de confirmation
                 lui a été établie et délivrée pour servir et Faire valoir ce de droit.
            </div>
        </main>
        <footer>
            <div>
                <span>Fait à Kalamu, le {{ $attestation->dateED }}</span>
                <br>
                <span>Le Bourgmestre</span>			          
            </div>
        </footer>
    </div>
    <button onclick="printPage()">Imprimer</button>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>
</html>