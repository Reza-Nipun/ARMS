import axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Link } from 'react-router-dom';
import { Table, Button, Modal, ModalHeader, ModalBody, ModalFooter, Input, FormGroup, Label } from 'reactstrap';
import Header from './Header';
import Footer from './Footer';
import "bootstrap/dist/css/bootstrap.min.css";
import Pagination from 'react-js-pagination';
import { Container, Row, Col } from 'reactstrap';


export default class Example extends Component {

    constructor () {
        super()
        this.state = {
            documents: null,
            units: [],
            departments: [],
            service_types: [],
            document_list: null
        }
    }

    async componentWillMount(){
        await this.getDocumentsData();
        await this.getUnits();
        await this.getDepartments();
        await this.getServiceTypes();
    }

    async getUnits(){

        // fetch('http://10.234.15.25/arms/api/document_list')
        //     .then(response => response.json())
        //     .then(json => this.setState({ units: json.data }));

        const url = 'http://10.234.15.25/arms/api/units';

        const response = await axios.get(url);

        this.setState({ units: response.data });
    }

    async getDepartments(){

        // fetch('http://10.234.15.25/arms/api/document_list')
        //     .then(response => response.json())
        //     .then(json => this.setState({ units: json.data }));

        const url = 'http://10.234.15.25/arms/api/departments';

        const response = await axios.get(url);

        this.setState({ departments: response.data });
    }

    async getServiceTypes(){

        // fetch('http://10.234.15.25/arms/api/document_list')
        //     .then(response => response.json())
        //     .then(json => this.setState({ units: json.data }));

        const url = 'http://10.234.15.25/arms/api/service_types';

        const response = await axios.get(url);

        this.setState({ service_types: response.data });
    }

    async getDocumentsData(pageNumber = 1){

        const url = `http://10.234.15.25/arms/api/document_list?page=${pageNumber}`;

        const response = await axios.get(url);

        this.setState({ documents: response.data });
    }

    renderDocumentList(){

        const { data, current_page, per_page, total } = this.state.documents;

        return (

            <React.Fragment>

                    {data.map((document, index) => {
                        {/*return <li className="list-group-item" key={index}>{ document.item_name }</li>*/}

                        return <tr key={index}>
                                    <td style={{ textAlign: 'center' }}>{ document.id }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.item_name }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.service_type }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.brand }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.model }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.serial_no }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.unit }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.department }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.user }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.original_placement_location}</td>
                                    <td style={{ textAlign: 'center' }}>{ document.original_document_location }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.last_renewal_date }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.next_renewal_date }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.vendor }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.amount }</td>
                                    <td style={{ textAlign: 'center' }}>{ document.remarks }</td>
                                    <td style={{ textAlign: 'center' }}></td>
                                </tr>
                    })
                    }


                <tr>
                    <td colSpan="17" className="justify-content-md-center">
                        <Pagination
                            activePage={current_page}
                            totalItemsCount={total}
                            itemsCountPerPage={per_page}
                            onChange={(pageNumber) => this.getDocumentsData(pageNumber)}
                            itemClass="page-item"
                            linkClass="page-link"
                            firstPageText="First"
                            lastPageText="Last"
                        />
                    </td>
                </tr>
            </React.Fragment>

        );
    }

    searchDocuments(){
        this.state.documents = null;

        // var value = $("#unit").val();
        var unit_ref = this.refs.unit_ref.value;
        // var department_ref = this.refs.department_ref.value;
        // var service_type_ref = this.refs.service_type_ref.value;
        // var from_date_ref = this.refs.from_date_ref.value;
        // var to_date_ref = this.refs.to_date_ref.value;

        const url = `http://10.234.15.25/arms/api/get_documents/`+unit_ref+`?page=${pageNumber}`;

        const response = axios.get(url);

        this.setState({ documents: response.data });
    }

    render () {

        const { documents } = this.state;

        return (
            <React.Fragment>
                <div className='container'>
                    <div className="row text-center">
                        <div className="col-md-12">
                            <h1>DOCUMENTS</h1>
                        </div>
                    </div>
                </div>
                <br />
                <Container>
                    <Row>
                        <Col>
                            <select className="form-control" name="unit" id="unit" ref="unit_ref">
                                <option value="">Unit</option>
                                {this.state.units.map(unit => (<option key={unit.id} value={unit.id}>{unit.name}</option>))}
                            </select>
                        </Col>
                        <Col>
                            <select className="form-control" name="department" id="department" ref="department_ref">
                                <option value="">Department</option>
                                {this.state.departments.map(department => (<option key={department.id} value={department.id}>{department.name}</option>))}
                            </select>
                        </Col>
                        <Col>
                            <select className="form-control" name="service_type" id="service_type" ref="service_type_ref">
                                <option value="">Service Type</option>
                                {this.state.service_types.map(service_type => (<option key={service_type.id} value={service_type.id}>{service_type.name}</option>))}
                            </select>
                        </Col>
                        <Col>
                            <input type="date" className="form-control" name="from_date" id="from_date" ref="from_date_ref" />
                            <label>Renew Date From</label>
                        </Col>
                        <Col>
                            <input type="date" className="form-control" name="to_date" id="to_date" ref="to_date_ref" />
                            <label>Renew Date To</label>
                        </Col>
                        <Col>
                            <Button className="btn btn-success" onClick={this.searchDocuments.bind(this)}>SEARCH</Button>
                        </Col>
                    </Row>
                </Container>
                <br />
                {/*<div className='container' style={{ height: '100%', position: 'absolute', left: '0px', width: '100%' }}>*/}
                    <div className='row'>
                        <div className='col-md-12'>
                            <Table striped bordered hover>
                                <thead>
                                    <tr style={{ backgroundColor: '#c9fa73' }}>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>#</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Item</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Service</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Brand</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Model</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Series</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Unit</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Dept.</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Liable Person</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Orig. Loc.</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Doc. Loc.</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Last Renew</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Next Renew</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Vendor</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Amount</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Remarks</th>
                                        <th style={{ textAlign: 'center', fontSize: '18px' }}>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        documents && this.renderDocumentList()
                                    }
                                </tbody>
                            </Table>

                        </div>
                    </div>
                {/*</div>*/}
            </React.Fragment>
        )
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
