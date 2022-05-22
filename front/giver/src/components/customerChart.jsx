import React from "react";
import { $ } from 'react-jquery-plugin'
import serverConfig from "../serverConfig";
import { Chart } from "react-google-charts";
import {Container, Row, Col} from 'react-bootstrap';

class CustomerChart extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            loaded: false
        };
    }

    getApi() {
        if (!this.state.loaded) {
            $.ajax({
                type: "GET",
                dataType: 'JSON',
                url: serverConfig.apiUrl + "/giver/api/view/customers/charts_data.php",
                success: response => {
                    this.setState({data: response, loaded: true});
                }
            });
        }
    }


    render() {
        this.getApi();

        if (this.state.data.empty === true) {
            return false;
        }

        let data = [
            ['Linguagens', 'Quantidade'],
            [`E-mail válido (${this.state.data.count_valid_email})`, this.state.data.count_valid_email],
            [`E-mail inválido (${this.state.data.count_invalid_email})`, this.state.data.count_invalid_email],
            [`Clientes com sobrenome (${this.state.data.count_with_last_name})`, this.state.data.count_with_last_name],
            [`Clientes sem sobrenome (${this.state.data.count_without_last_name})`, this.state.data.count_without_last_name],
            [`Clientes com gênero (${this.state.data.count_with_gender})`, this.state.data.count_with_gender],
            [`Clientes sem gênero (${this.state.data.count_without_gender})`, this.state.data.count_without_gender]
        ];

        return (
            <Container style={{marginTop: 20}}>
                 <Row>
                    <Col sm={6} lg={6} md={6}>
                        <Chart
                            height={'300px'}
                            chartType="BarChart"
                            data={data}
                        />
                    </Col>

                    <Col sm={6} lg={6} md={6}>
                        <Chart
                            height={'300px'}
                            chartType="PieChart"
                            data={data}
                        />
                    </Col>
                </Row>
            </Container>
        );
    }
}

export default CustomerChart;
