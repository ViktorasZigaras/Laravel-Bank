export const displayErrorMessages = (errors, specificError) => {
    console.log(errors);
    let html = `
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="alert">
                        <ul class="list-group">
    `;
    if (errors) {
        Object.entries(errors).forEach( (error) => {
            html += `
                            <li class="list-group-item list-group-item-danger"> ${ error[1] } </li>
            `;
        });
    }
    if (specificError) {
        html += `
                            <li class="list-group-item list-group-item-danger"> ${ specificError }</div>
        `;
    };
    html += `
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    `;   
    document.querySelector('#messages').innerHTML = '';
    document.querySelector('#errors').innerHTML = html;
}

export const displayMessages = (sucessMessage, infoMessage) => {
    let html = `
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="alert">    
    `;
    if (sucessMessage) {
        html += `
                        <div class="alert alert-success" role="alert"> ${ sucessMessage } </div>
        `;
    };
    if (infoMessage) {
        html += `
                        <div class="alert alert-success" role="alert"> ${ infoMessage } </div>
        `;
    };
    html += `
                    </div>
                </div>
            </div>
        </div>
    `;   
    document.querySelector('#errors').innerHTML = '';
    document.querySelector('#messages').innerHTML = html;
}