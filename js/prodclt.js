document.querySelector("#editClt").onclick = ()=>{
    document.querySelector("#products").classList.add('displayed');
    document.querySelector("#clients").classList.remove('displayed');    
}
document.querySelector("#editProd").onclick = ()=>{
    document.querySelector("#products").classList.remove('displayed');
    document.querySelector("#clients").classList.add('displayed');    
}