function doMenu() {
    // console.log("dssssssssssssssssssssssssssss");
    // console.log(men.value);
    let url = menu.value;
    if (url!=""){
        //console.log(menu.value)
        if (url.includes("http")) {
            window.open(url); 
            } else {
                location.href = url;
            }
        }
    }
function doMenu() {
    const menu = document.getElementById("menu");
    let url = menu.value;
    if (url !== ""){
        console.log(url);
        window.location.href = url; // Uncomment to actually navigate to the selected URL
    }
}