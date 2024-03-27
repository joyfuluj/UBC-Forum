function loadDefaults(){
    let div = $('#sideMenuContent');
    let divOp = $("#sideOptions");
    div.empty();
    divOp.empty();
    let content = $(`
        <h3>Dashboard Options</h3>  
    `);
    div.append(content);
}