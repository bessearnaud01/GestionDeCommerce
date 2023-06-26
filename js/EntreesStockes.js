
// Le nombre de variable sur la page

let numberOfItems = 3;
let first = 0; //L'index
let actualPage = 1 //elle sert aller sur une une autre page
let maxpages = Math.ceil(StockesEntrees.length / numberOfItems);
let tableList = '';

// créaction de la fonction
showList();
//on veut veut afficher la première page 
function firstPage(){
     first =0;
     actualPage =1;
     showList();
}

// cette fonction nous sert aller de l'avant et si l'index est négatif  on affiche pas de page  ou la valeur n'existe pas
// La fonction s'arrête à l'index 0 parce qu'il y a plus de valeur qui  existe a l'index -1
function previous(){
    if(first -numberOfItems >=0){
        first -= numberOfItems; // Elle sert à aller à aller en avant
        actualPage--
        showList()
    }
}


function nextPage(){
   console.log(actualPage,maxpages)
    // Si les index est égale au nombre de variable de notre list il y a plus de prochain page on s'arrête
    if(actualPage<maxpages){
        first += numberOfItems; // Elle afficher la prochain page
        actualPage++;
        showList();
    }
}


// Elle sert à afficher la dernière page

function lastPage(){
    first = (maxpages *numberOfItems)- numberOfItems;
    actualPage = maxpages;
    showList();
    

    
}

function showList(){
    tableList=''  
        for(let i = first; i < first + numberOfItems;i++){
         if(i< StockesEntrees.length){
          tableList += `
          <tr>
                            <td> ${StockesEntrees[i].idStocke} </td>
                            <td> ${StockesEntrees[i].idFournisseur} </td>
                            <td> ${StockesEntrees[i].libelle}</td>
                            <td> ${StockesEntrees[i].prixUnitaire} </td>
                            <td> ${StockesEntrees[i].quantite}</td>
                            <td> ${StockesEntrees[i].montant} </td>
                            <td> ${StockesEntrees[i].date} </td>
          <td> <a href="EditeStockeEntre.php?&id=${StockesEntrees[i].idStocke}" target="_self"><i class="fas fa-edit"></i></a> &nbsp
          <a onclick ="return confirm(' Êtes vous sûr de vouloir supprimer la famille du produit')";
          href="SupprimeStockEntre.php?&id=${StockesEntrees[i].idStocke}" target="_self"><i class="fas fa-trash-alt"></i> </a>
          </td>
          </tr>
        
        `  
      }
    }
    document.getElementById('StockesEntrees').innerHTML = tableList;
    showPageInfo();
  }
  // Elle nous sert afficher le nombre de page
  function showPageInfo(){
      document.getElementById('pageInfo').innerHTML = `Page ${actualPage} / ${maxpages}`

  }





