function loadDefaults(){
    if(isMobileSite()){
        $("#sideMenu").hide();
    }
    let div = $('#sideMenuContent');
    let divOp = $("#sideOptions");
    div.empty();
    divOp.empty();
    let content = $(`
        <h3>Dashboard Options</h3>  
    `);
    div.append(content);
}
function isMobileSite() {
    return window.innerWidth <= 800;
}