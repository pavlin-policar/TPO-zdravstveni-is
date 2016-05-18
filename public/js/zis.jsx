class Dashboard extends React.Component {
    render() {
        return <div>{this.props.children}</div>
    }
}

const Row = props => (
    <div className="row">{props.children}</div>
);

class InlineDashboardComponent extends React.Component {
    render() {
        
    }
}

class DashboardComponent extends React.Component {
    render() {
        return (
            <div className="card card-no-padding" {...this.props}>
                {this.props.children}
            </div>
        )
    }
}

const Title = props => (
    <div className="card-header">
        <div className="card-title">
            <div className="title" {...this.props}>{props.children}</div>
        </div>
        <div class="fa fa-compress icon-arrow-right" id="glyphicon-user"></div>
    </div>
);

const Body = props => (
    <div className="card-body no-padding" {...this.props}>
        {props.children}
    </div>
);