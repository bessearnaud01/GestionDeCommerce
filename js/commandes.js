// Le nombre de variable sur la page

let numberOfItems = 3;
let first = 0; //L'index
let actualPage = 1 //elle sert aller sur une une autre page
let maxpages = Math.ceil(commandes.length / numberOfItems);
let tableList = '';

// créaction de la fonction
showList();
//on veut veut afficher la première page 
function firstPage() {
    first = 0;
    actualPage = 1;
    showList();
}

// cette fonction nous sert aller de l'avant et si l'index est négatif  on affiche pas de page  ou la valeur n'existe pas
// La fonction s'arrête à l'index 0 parce qu'il y a plus de valeur qui  existe a l'index -1
function previous() {
    if (first - numberOfItems >= 0) {
        first -= numberOfItems; // Elle sert à aller à aller en avant
        actualPage--
        showList()
    }
}


function nextPage() {
    // Si les index est égale au nombre de variable de notre list il y a plus de prochain page on s'arrête
    if (actualPage < maxpages) {
        first += numberOfItems; // Elle afficher la prochain page
        actualPage++;
        showList();
    }
}


// Elle sert à afficher la dernière page

function lastPage() {
    first = (maxpages * numberOfItems) - numberOfItems;
    actualPage = maxpages;
    showList();

}

function showList() {
    tableList = ''
    for (let i = first; i < first + numberOfItems; i++) {
        if (i < commandes.length) {
            tableList += `
          <tr>
          <td> ${commandes[i].idCommande} </td>
          <td> ${commandes[i].nomClient}</td>
          <td> ${commandes[i].nomProduit}</td>
          <td> ${commandes[i].prixUnitaire} </td>
           <td> ${commandes[i].quantite} </td>
          <td> ${commandes[i].montant} </td>
          <td> ${commandes[i].date} </td>
          <td> <a href="EditeCommande.php?&id=${commandes[i].idCommande}" target="_self"><i class="fas fa-edit"></i></a> &nbsp
          <a onclick ="return confirm(' Êtes vous sûr de vouloir supprimer le produit')";
           href="SupprimeCommande.php?&id=${commandes[i].idCommande}" target="_self"> <i class="fas fa-trash-alt"></i> </a>
          </td>
      </tr>  
          
        
        `
        }
    }
    document.getElementById('commandes').innerHTML = tableList;
    showPageInfo();
}
// Elle nous sert afficher le nombre de page
function showPageInfo() {
    document.getElementById('pageInfo').innerHTML = `Page ${actualPage} / ${maxpages}`

}