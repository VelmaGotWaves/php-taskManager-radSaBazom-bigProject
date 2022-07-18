document.querySelectorAll(".tabDugme").forEach(dugme => {
    dugme.addEventListener("click", e=>{
        
        dataVrednost=e.currentTarget.dataset.vrednost;
        console.log(dataVrednost);
        
        document.querySelectorAll(".tabDugme").forEach(element => {
            element.classList.remove("dugme-active");
            if(element.dataset.vrednost==dataVrednost){
                element.classList.add("dugme-active");
            } 

        });
        
        
        document.querySelectorAll(".forma").forEach(element => {
            element.classList.remove("forma-active");
            if(element.dataset.vrednost==dataVrednost){
                element.classList.add("forma-active")
            } 
            
        });
    })
});