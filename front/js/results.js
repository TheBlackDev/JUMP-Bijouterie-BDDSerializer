function updateCarousselOnClick(clickedButton) {
    let tile_top = clickedButton.parentElement.parentElement.parentElement;
    let no = clickedButton.className.split(' ')[1];
    Array.from(tile_top.getElementsByClassName('nav_dot')).forEach(element => {
        element.className = element.className.replace(' active', '');
        if(element.className.split(' ')[1] == no) {
            element.className += ' active';
        }
    });
    tile_top.getElementsByClassName('carousel')[0].scrollTo({'left': no * tile_top.getElementsByClassName('carousel')[0].offsetWidth, 'behavior':'smooth'});
}

function playVideo(clickedButton) {
    
}