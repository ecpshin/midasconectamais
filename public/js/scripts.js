const form = document.getElementById("form_modal");

$(document).ready(function () {
    $("#tabela").DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 15],
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json",
        },
    });
    new DataTable("#table_export", {
        bFilter: false,
        layout: {
            topStart: "buttons",
        },
        buttons: [
            "excel",
            {
                extend: "pdf",
                text: "PDF",
                orientation: "landscape",
                pageSize: "A4",
            },
            {
                extend: "print",
                text: "Print",
                orientation: "landscape",
                pageSize: "A4",
            },
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json",
        },
    });

    /*    $("#table_export").dataTable({
        dom: "Blfrtip",
        buttons: [
            "excel",
            {
                extend: "pdf",
                text: "PDF",
                orientation: "landscape",
                pageSize: "A4",
            },
        ],

    });*/

    $("#listas").DataTable({
        pageLength: 10,
        lengthMenu: [5, 10],
        lengthChange: true,
        searching: true,
        autoWidth: false,
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.0/i18n/pt-BR.json",
        },
    });

    $(".select2").select2();
    $(".valor").mask("##0.00", {
        reverse: true,
    });

    $(".percentual").mask("999.99", {
        reverse: true,
    });

    $(".cpf").mask("999.999.999-99");

    $(".phone").mask("(99)9 9999-9999");

    $(".telefone").mask("(99)9 9999-9999");
});

function modalMailing(id) {
    const result = new Date().toLocaleDateString("pt-BR");
    console.log(result);
    const mailingUrl = $(`#show_${id}`).data("url");
    $.get(mailingUrl, function (data) {
        const aux =
            data.data_consulta != null
                ? data.data_consulta
                : $("#modal-date").val();

        $("#modal-id").val(data.id);
        $("#modal-nome").val(data.nome);
        $("#modal-date").val();
        $("#modal-cpf").val(data.cpf);
        $("#modal-matricula").val(data.matricula);
        $("#modal-orgao").val(data.orgao);
        $("#modal-margem").val(data.margem);
        $("#modal-observacoes").val(data.obs);
    });
}

function modalLista(id) {
    const callUrl = $(`#call_${id}`).data("url");
    const updateUrl = $(`#call_${id}`).data("update");
    $.get(callUrl, function (data) {
        const dados = data.data;
        console.log(dados)
        const dataAtual = new Date()
            .toISOString()
            .slice(0, 10)
            .split("/")
            .reverse()
            .join("-");
        $("mcall_id").val(dados.id);
        if (dados.user_id !== null) {
            $("#muser_id").val(dados.user_id);
        }
        $("#mstatus_id").val(dados.status_id);
        $("#mdata_ligacao").val(
            dados.data_ligacao != null ? dados.data_ligacao : dataAtual
        );
        $("#mdata_agendamento").val(
            dados.data_agendamento != null ? dados.data_agendamento : dataAtual
        );
        $("#mnome").val(dados.nome);
        $("#mcpf").val(dados.cpf);
        $("#mmatricula").val(dados.matricula);
        $("#mmargem").val(dados.margem);
        $("#mtelefone").val(dados.telefone);
        $("#morgao").val(dados.organizacao_id);
        $("#mproduto").val(dados.produto_id);
        $("#mobservacoes").text(`${dados.observacoes}`);
        $("#gov-update").attr("action", updateUrl);

        $("#orgao-helper-text").text((dados.orgao != null ? dados.orgao : 'Não selecionado'));
        $("#produto-helper-text").text((dados.produto != null ? '' : 'Não selecionado'));
        $("#status-helper-text").text((dados.status_id != null ? '' : 'Não selecionado'));
    });
}

function carrega(el) {
    const v = el.options[el.selectedIndex].text;
    $("#percentual_loja").val(Number(v.split("|")[1]).toFixed(2));
}

function loadCliente(cliente) {
    const data = JSON.parse(cliente);
    $("#cliente_id").val(data.id);
    $("#cpf").val(data.cpf);
    $("#nome").val(data.nome);
}

function fn(valor) {
    const v = valor.value.toUpperCase();
    valor.value = v;
}

function confirmar(id) {
    const ok = confirm("Deseja excluir este registro? " + id);
    ok && document.getElementById(`form_${id}`).submit();
}

function preencheModal(proposta, cli, comissao) {
    let nf = new Intl.NumberFormat("pt-BR");
    const {
        id,
        cliente_id,
        data_digitacao,
        data_pagamento,
        uuid,
        numero_contrato,
        prazo_proposta,
        total_proposta,
        parcela_proposta,
        liquido_proposta,
        operacao_id,
        financeira_id,
        correspondente_id,
        situacao_id,
        user_id,
    } = JSON.parse(proposta);
    const { cpf, nome } = JSON.parse(cli);
    const {
        valor_loja,
        percentual_loja,
        percentual_operador,
        valor_operador,
        tabela_comissao,
    } = JSON.parse(comissao);

    $("#digitacao").val(formatDate(data_digitacao));
    $("#pagamento").val(formatDate(data_pagamento));
    $("#uuids").val(uuid);
    $("#nrcontrato").val(
        numero_contrato == null ? "Não informado" : numero_contrato
    );
    $("#cliente_id").val(cliente_id);
    $("#cpf").val(cpf);
    $("#nome").val(nome);
    $("#prazo").val(prazo_proposta);
    $("#total").val(Number(total_proposta).toFixed(2));
    $("#parcela").val(Number(parcela_proposta).toFixed(2));
    $("#liquido").val(Number(liquido_proposta).toFixed(2));
    $("#tabcom").val(tabela_comissao);
    $("#percloja").val(Number(percentual_loja).toFixed(2));
    $("#valloja").val(Number(valor_loja).toFixed(2));
    $("#percop").val(Number(percentual_operador).toFixed(2));
    $("#valop").val(Number(valor_operador).toFixed(2));

    $("#op").val(operacao_id);
    $("#fin").val(financeira_id);
    $("#corr").val(correspondente_id);
    $("#sitc").val(situacao_id);

    const cUrl = `${document.location.href}/${id}/atualizar-proposta`;
    document.getElementById("form_modal").action = cUrl;
}

function removeItems() {
    localStorage.removeItem("proposta");
    localStorage.removeItem("cliente");
    localStorage.removeItem("op");
    localStorage.removeItem("fin");
    localStorage.removeItem("corr");
    localStorage.removeItem("sitc");
    localStorage.removeItem("comissao");
}

function conversor(valor) {
    valor.value =
        valor.value.indexOf(",") > 0
            ? valor.value.replace(",", ".")
            : valor.value;
}

function calculaComissao() {
    const liquido = Number($("#liquido").val());
    const percentual = Number($("#percop").val());
    const calculo = (percentual * liquido) / 100;
    $("#valop").val(calculo.toFixed(2));
}

function calcularComissoes() {
    const total_proposta = $("#total_proposta").val();
    const liquido_proposta = $("#liquido_proposta").val();
    const perc_loja = $("#perc_loja").val();
    const perc_agente = $("#perc_agente").val();
    const perc_corretor = $("#perc_corretor").val();

    const referencia = localStorage.getItem("referencia");

    let valor_loja = 0;
    let valor_agente = 0;
    let valor_corretor = 0;

    if (referencia === "B") {
        valor_loja = Number(total_proposta) * (Number(perc_loja) / 100);
        valor_agente = Number(total_proposta) * (Number(perc_agente) / 100);
        valor_corretor = Number(total_proposta) * (Number(perc_corretor) / 100);

        $("#val_loja").val(valor_loja.toFixed(2));
        $("#val_agente").val(valor_agente.toFixed(2));
        $("#val_corretor").val(valor_corretor.toFixed(2));
    }

    if (referencia === "BL") {
        valor_loja = Number(total_proposta) * (Number(perc_loja) / 100);
        valor_agente = Number(liquido_proposta) * (Number(perc_agente) / 100);
        valor_corretor =
            Number(liquido_proposta) * (Number(perc_corretor) / 100);
        $("#val_loja").val(valor_loja.toFixed(2));
        $("#val_agente").val(valor_agente.toFixed(2));
        $("#val_corretor").val(valor_corretor.toFixed(2));
    }

    if (referencia == "L") {
        valor_loja = Number(liquido_proposta) * (Number(perc_loja) / 100);
        valor_agente = Number(liquido_proposta) * (Number(perc_agente) / 100);
        valor_corretor =
            Number(liquido_proposta) * (Number(perc_corretor) / 100);
        $("#val_loja").val(valor_loja.toFixed(2));
        $("#val_agente").val(valor_agente.toFixed(2));
        $("#val_corretor").val(valor_corretor.toFixed(2));
    }
}

function atualizarComissoes() {
    alert("Chamei");
    const total_proposta = $("#total_proposta").val();
    const liquido_proposta = $("#liquido_proposta").val();
    const perc_loja = $("#perc_loja").val();
    const perc_agente = $("#perc_agente").val();
    const perc_corretor = $("#perc_corretor").val();

    const referencia = localStorage.getItem("referencia");

    let valor_loja = 0;
    let valor_agente = 0;
    let valor_corretor = 0;

    if (referencia === "B") {
        valor_loja = Number(total_proposta) * (Number(perc_loja) / 100);
        valor_agente = Number(total_proposta) * (Number(perc_agente) / 100);
        valor_corretor = Number(total_proposta) * (Number(perc_corretor) / 100);

        $("#val_loja").val(valor_loja.toFixed(2));
        $("#val_agente").val(valor_agente.toFixed(2));
        $("#val_corretor").val(valor_corretor.toFixed(2));
    }

    if (referencia === "BL") {
        valor_loja = Number(total_proposta) * (Number(perc_loja) / 100);
        valor_agente = Number(liquido_proposta) * (Number(perc_agente) / 100);
        valor_corretor =
            Number(liquido_proposta) * (Number(perc_corretor) / 100);
        $("#val_loja").val(valor_loja.toFixed(2));
        $("#val_agente").val(valor_agente.toFixed(2));
        $("#val_corretor").val(valor_corretor.toFixed(2));
    }

    if (referencia == "L") {
        valor_loja = Number(liquido_proposta) * (Number(perc_loja) / 100);
        valor_agente = Number(liquido_proposta) * (Number(perc_agente) / 100);
        valor_corretor =
            Number(liquido_proposta) * (Number(perc_corretor) / 100);
        $("#val_loja").val(valor_loja.toFixed(2));
        $("#val_agente").val(valor_agente.toFixed(2));
        $("#val_corretor").val(valor_corretor.toFixed(2));
    }
}

function formatDate(date) {
    var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = "0" + month;
    if (day.length < 2) day = "0" + day;

    return [year, month, day].join("-");
}

$("#buscaCep").on("blur", async function () {
    const cep = $("#buscaCep").val();
    if (cep !== "") {
        let response = (
            await fetch(`https://viacep.com.br/ws/${cep}/json/`, {
                mode: "cors",
            })
        ).json();
        let data = await response;
        const { logradouro, bairro, localidade, uf } = data;
        $("#logradouro").val(logradouro);
        $("#bairro").val(bairro);
        $("#localidade").val(localidade);
        $("#uf").val(uf);
    }
});

$("#buscaBanco").on("blur", async function (e) {
    const codigoBanco = e.target.value;

    if (codigoBanco !== "") {
        let response = (
            await fetch(
                `https://brasilapi.com.br/api/banks/v1/${codigoBanco}`,
                {
                    mode: "cors",
                }
            )
        ).json();
        const { code, fullName } = await response;

        $("#banco").val(fullName);

        $("#buscaBanco").val(converte(code));

        function converte(codigo) {
            let aux = `${codigo}`;
            if (aux.length == 1 || aux.length == 2) {
                return aux.padStart(3, "0");
            }
            return aux;
        }
    }
});

//testes
$("#modal-obs").on("change", function () {
    const n = $("#modal-obs").val();
    alert(n);
});

function loadCliente(obj) {
    const data = JSON.parse(obj);
    $("#cliente_id").val(data.id);
    $("#nome_cliente").val(data.nome);
    $("#cpf_cliente").val(data.cpf);
}

$("#organizacao_id").on("change", function () {
    let url = $("#organizacao_id").data("url");
    const id = $("#organizacao_id").val();
    url = `${url.slice(0, -2)}/${id}`;

    $.get(url, function (res) {
        const tabelas = res.data;
        const selectProduto = document.querySelector("#produto_id");
        const opt = document.createElement("option");
        selectProduto.innerHTML = null;
        opt.value = 0;
        opt.text = "Selecione...";
        selectProduto.append(opt);

        tabelas.map((tabela) => {
            const option = document.createElement("option");
            option.value = `${tabela.produto.id}`;
            option.innerText = `${tabela.produto.descricao_produto}`;
            selectProduto.append(option);
        });
    });
});

$("#produto_id").on("change", function () {
    const produto = $("#produto_id").val();
    const orgao = $("#organizacao_id").val();
    let url = $("#produto_id").data("url").slice(0, -1);
    url += `${orgao}/${produto}`;

    $.get(url, function (res) {
        const tabelas = res.data;
        const selectFinanceira = document.querySelector("#financeira_id");
        const opt = document.createElement("option");
        opt.value = 0;
        opt.text = "Selecione...";
        selectFinanceira.innerHTML = null;
        selectFinanceira.append(opt);

        tabelas.map((tabela) => {
            const option = document.createElement("option");
            option.value = `${tabela.financeira.id}`;
            option.innerText = `${tabela.financeira.nome_financeira}`;
            selectFinanceira.append(option);
        });
    });
});

$("#financeira_id").on("change", function () {
    const financeira = $("#financeira_id").val();
    const produto = $("#produto_id").val();
    const orgao = $("#organizacao_id").val();
    let url = $("#financeira_id").data("url").slice(0, -1);
    url += `${orgao}/${produto}/${financeira}`;

    $.get(url, function (res) {
        const tabelas = res.data;
        const selectCorrespondente =
            document.querySelector("#correspondente_id");
        const opt = document.createElement("option");
        opt.value = 0;
        opt.text = "Selecione...";
        selectCorrespondente.innerHTML = null;
        selectCorrespondente.append(opt);

        tabelas.map((tabela) => {
            const option = document.createElement("option");
            option.value = `${tabela.correspondente.id}`;
            option.innerText = `${tabela.correspondente.nome_correspondente}`;
            selectCorrespondente.append(option);
        });
    });
});

$("#correspondente_id").on("change", function () {
    const correspondente = $("#correspondente_id").val();
    const financeira = $("#financeira_id").val();
    const produto = $("#produto_id").val();
    const orgao = $("#organizacao_id").val();
    let url = $("#correspondente_id").data("url").slice(0, -1);

    url += `${orgao}/${produto}/${financeira}/${correspondente}`;

    console.log(url);

    $.get(url, function (res) {
        const tabelas = res.data;
        console.log(tabelas);

        const selectTabelas = document.querySelector("#tabela_id");
        const opt = document.createElement("option");
        opt.value = 0;
        opt.text = "Selecione...";
        selectTabelas.innerHTML = null;
        selectTabelas.append(opt);

        tabelas.map((tabela) => {
            const option = document.createElement("option");
            option.value = `${tabela.id}`;
            option.innerText = `${tabela.descricao} -> ${tabela.codigo} -> ${tabela.prazo}`;
            selectTabelas.append(option);
        });
    });
});

$("#tabela_id").on("change", function () {
    const valor = $("#tabela_id").val();
    let url = $("#tabela_id").data("url").slice(0, -1);
    url += `${valor}`;

    $.get(url, function (res) {
        const rs = res.data;
        $("#prazo_proposta").val(rs.prazo.replace("~", ""));
        $("#correspondente_id").val(rs.correspondente.id);
        $("#financeira_id").val(rs.financeira.id);
        $("#percentual_loja").val(rs.percentual_loja);
        $("#produto_id").val(rs.produto.id);
        $("#perc_loja").val(Number(rs.percentual_loja).toFixed(2));
        $("#perc_agente").val(Number(rs.percentual_agente).toFixed(2));
        $("#perc_corretor").val(Number(rs.percentual_corretor).toFixed(2));

        localStorage.setItem("referencia", rs.referencia);
    });
});

$("#orgao_id").on("change", function () {
    const option = $("#orgao_id").val();
    $("#organizacao_id").val(option);
});
