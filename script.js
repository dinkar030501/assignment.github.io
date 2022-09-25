function search(){
        let input = document.querySelector('.display_search_box');
        let filter = input.value.toUpperCase();
        let block = document.getElementsByClassName('block');

        for(let i = 0; i < block.length ;i++ ){
            let element = block[i].getElementsByTagName('h2');
            if(element[0].innerHTML.toUpperCase().indexOf(filter) > -1 || element[1].innerHTML.toUpperCase().indexOf(filter) > -1 || element[2].innerHTML.toUpperCase().indexOf(filter) > -1){
                block[i].style.display = "";
            }else{
                block[i].style.display = "none";
            }
        }
}

function toggleLike(id){
    document.getElementsByClassName('like_button')[id-1].classList.toggle('liked');
}

// document.querySelector('.like_button').addEventListener(onclick,toggleLike());