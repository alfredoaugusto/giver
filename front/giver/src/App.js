import './App.css';
import React from "react";
import CustomerChart from "./components/customerChart";
import CustomerTable from "./components/customerTable";

class App extends React.Component {
  getCharts() {
    return (
      <div> 
        <CustomerChart />
      </div>
    );
  }

  getList() {
    return (
      <div>
        <CustomerTable />
      </div>
    )
  }

  render() {
    return (
      <div className="App"> 
        {this.getCharts()}
        {this.getList()}
      </div>
    );
  }
}

export default App;
