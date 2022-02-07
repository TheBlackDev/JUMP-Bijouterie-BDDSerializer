function updateCarousselOnClick(clickedButton) {
    let tile_top = clickedButton.parentElement.parentElement.parentElement;
    let no = clickedButton.className.split(' ')[1];
    try {
        clickedButton.parentElement.parentElement.parentElement.getElementsByClassName("video_container")[0].getElementsByTagName("video")[0].pause();
    }
    catch(e) {}
    
    Array.from(tile_top.getElementsByClassName('nav_dot')).forEach(element => {
        console.log(element);
        element.className = element.className.replace(' active', '');
        if(element.className.split(' ')[1] == no) {
            element.className += ' active';
        }
    });
    tile_top.getElementsByClassName('carousel')[0].scrollTo({'left': no * tile_top.getElementsByClassName('carousel')[0].offsetWidth, 'behavior':'smooth'});
}