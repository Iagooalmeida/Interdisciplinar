const KEY_BD = '@usuarios'


var listaRegistros = {
    ultimoIdGerado:0,
    usuarios:[]
}

var FILTRO = ''


function gravarBD(){
    localStorage.setItem(KEY_BD, JSON.stringify(listaRegistros) )
}

function lerBD(){
    const data = localStorage.getItem(KEY_BD)
    if(data){
        listaRegistros = JSON.parse(data)
    }
    desenhar()
}


function pesquisar(value){
    FILTRO = value;
    desenhar()
}


function desenhar(){
    const tbody = document.getElementById('listaRegistrosBody')
    if(tbody){
        var data = listaRegistros.usuarios;
        if(FILTRO.trim()){
            const expReg = eval(`/${FILTRO.trim().replace(/[^\d\w]+/g,'.*')}/i`)
            data = data.filter( usuario => {
                return expReg.test( usuario.nome_user ) || expReg.test( usuario.email_user )
            } )
        }
        data = data
            .sort( (a, b) => {
                return a.nome_user < b.nome_user ? -1 : 1
            })
            .map( usuario => {
                return `<tr>
                    <td>${usuario.id}</td>
                    <td>${usuario.nome_user}</td>
                    <td>${usuario.telefone_user}</td>
                    <td>${usuario.email_user}
                    <td>
                        <button onclick='vizualizar("cadastro",false,${usuario.id})'>Editar</button>
                        <button class='vermelho' onclick='perguntarSeDeleta(${usuario.id})'>Deletar</button>
                    </td>
            </tr>`
            } )
        tbody.innerHTML = data.join('')
    }
}

function insertUsuario(nome_user, telefone_user, email_user){
    const id = listaRegistros.ultimoIdGerado + 1;
    listaRegistros.ultimoIdGerado = id;
    listaRegistros.usuarios.push({
        id, nome_user, telefone_user, email_user
    })
    gravarBD()
    desenhar()
    vizualizar('lista')
}

function editUsuario(id, nome_user, telefone_user, email_user){
    var usuario = listaRegistros.usuarios.find( usuario => usuario.id == id )
    usuario.nome_user = nome_user;
    usuario.telefone_user = telefone_user;
    usuario.email_user = email_user;
    gravarBD()
    desenhar()
    vizualizar('lista')
}

function deleteUsuario(id){
    listaRegistros.usuarios = listaRegistros.usuarios.filter( usuario => {
        return usuario.id != id
    } )
    gravarBD()
    desenhar()
}

function perguntarSeDeleta(id){
    if(confirm('Quer deletar o registro de id '+id)){
        deleteUsuario(id)
    }
}


function limparEdicao(){
    document.getElementById("id").value = ""
    document.getElementById('nome_user').value = ''
    document.getElementById('telefone_user').value = ''
    document.getElementById('email_user').value = ''
}

function vizualizar(pagina, novo=false, id=null){
    document.body.setAttribute('page',pagina)
    if(pagina === 'cadastro'){
        if(novo) limparEdicao()
        if(id){
            const usuario = listaRegistros.usuarios.find( usuario => usuario.id == id )
            if(usuario){
                document.getElementById('id').value = usuario.id
                document.getElementById('nome_user').value = usuario.nome_user
                document.getElementById('telefone_user').value = usuario.telefone_user
                document.getElementById('email_user').value = usuario.email_user
            }
        }
        document.getElementById('nome_user').focus()
    }
}



function submeter(e){
    e.preventDefault()
    const data = {
        id: document.getElementById('id').value,
        nome_user: document.getElementById('nome_user').value,
        telefone_user: document.getElementById('telefone_user').value,
        email_user: document.getElementById('email_user').value,
    }
    if(data.id){
        editUsuario(data.id, data.nome_user, data.telefone_user, data.email_user)
    }else{
        insertUsuario( data.nome_user, data.telefone_user, data.email_user )
    }
}


window.addEventListener('load', () => {
    lerBD()
    document.getElementById('cadastroRegistro').addEventListener('submit', submeter)
    document.getElementById('inputPesquisa').addEventListener('keyup', e => {
        pesquisar(e.target.value)
    })

})