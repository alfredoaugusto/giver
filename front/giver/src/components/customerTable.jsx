import React from "react";
import axios from "axios";
import Papa from 'papaparse';
import {Row, Col} from 'react-bootstrap';
import { $ }  from 'react-jquery-plugin';
import serverConfig from "../serverConfig";
import { DataGrid } from '@mui/x-data-grid';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';

class CustomerTable extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            loaded: false
        };

        this.updateData = this.updateData.bind(this);
    }

    handleChange = event => {
        if (window.confirm('Deseja importar o arquivo?')) {
            this.importCSV(event.target.files[0]);
        }
    };
    
    importCSV = (file) => {
        Papa.parse(file, {
            complete: this.updateData,
            header: true
        });
    };

    updateData(result) {
        var data = result.data;

        $.ajax({
            type: "POST",
            url: serverConfig.apiUrl + "/giver/api/view/customers/add.php",
            data: {data: JSON.stringify(data)},
            success: () => {
                window.location.reload();
            },
            dataType: 'JSON'
          });
    }

    loadData() {
        if (!this.state.loaded) {
            const api = axios.create({
                baseURL: serverConfig.apiUrl + "/giver/api/view/customers",
            });
            
            api().then( response => {
                this.setState({data: response.data, loaded: true});
            })
        }
    }

    getToolbar() {
        return (
            <Row>
                <Col sm={3} lg={3} md={3}>
                    <div >
                        <input
                            className="csv-input"
                            type="file"
                            id="input-file"
                            ref={input => {
                                this.filesInput = input;
                            }}
                            name="file"
                            placeholder={null}
                            onChange={this.handleChange}
                            />
                            
                    </div>
                </Col>
            </Row>
        );
    }

    getColumns() {
        return [
            {field: "id", headerName: '#ID', width: 20 },
            {field: "first_name", headerName: 'Nome', width: 150 },
            {field: "last_name", headerName: 'Sobrenome', width: 150 },
            {field: "email", headerName: 'E-mail', width: 150 },
            {field: "gender", headerName: 'Gênero', width: 150 },
            {field: "ip_address", headerName: 'Endereço IP', width: 150 },
            {field: "company", headerName: 'Empresa', width: 150 },
            {field: "city", headerName: 'Cidade', width: 150 },
            {field: "title", headerName: 'Título', width: 150 },
            {field: "website", headerName: 'Website', width: 150 }
        ];
    }

    getData() {
        this.loadData();
        return this.state.data || [];
    }

    render() {
        return (
            <Container style={{marginTop: 20}}>
                {this.getToolbar()}
                <Row style={{marginTop: 20}}>
                <Col sm={12} lg={12} md={12}>
                        <div style={{ height: 500, width: '100%' }}>
                            <DataGrid rows={this.getData()} columns={this.getColumns()} />
                        </div>
                    </Col>
                </Row>
            </Container>
          );
    }
} 

export default CustomerTable;