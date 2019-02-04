function addButton(content, classe, url) {
  console.log(url);
  var element = document.createElement("a");
  element.appendChild(document.createTextNode(content));
  element.className += classe;
  element.onclick = function() {
    window.location.href = url;
  };
  document
    .getElementsByClassName("wc-proceed-to-checkout")[0]
    .appendChild(element);
}

function detailsForcedFees() {
  var details =
    "Montant des Frais de Service Client à payer par le client en centimes d' euros. Si présent, les frais des services correspondant au montant communiqué seront affichés sur le " +
    "formulaire et débités de la carte du client au moment de la validation. Pour un accord tarifaire standard, ce montant viendra réduire la commission Swikly pour le " +
    "Fournisseur, le montant exact facturé au Fournisseur est précisé dans le mail de livraison du lien ou à défaut dans votre contrat de service Swikly. Si à zéro, aucuns frais de " +
    "service ne sont débités au client. " +
    "Si vos conditions tarifaires Swikly intègrent un montant payé directement par votre client : " +
    "1 ‐ Si à zéro, le fait de forcer les frais de service à zéro reporte le montant convenu et normalement payé par le client sur la facture Fournisseur. " +
    "2 ‐ Si absent, le montant prévu au contrat de service Swikly pour ces Frais de Service Client sera payé par le client lors de l'acceptation du swik" +
    "Ce paramètre n'est pas pris en compte dans le cas d'une utilisation du formulaire pour sécuriser à la fois un swik caution et un swik réservation";

  alert(details);
}
