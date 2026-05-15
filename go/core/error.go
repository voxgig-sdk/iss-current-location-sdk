package core

type IssCurrentLocationError struct {
	IsIssCurrentLocationError bool
	Sdk              string
	Code             string
	Msg              string
	Ctx              *Context
	Result           any
	Spec             any
}

func NewIssCurrentLocationError(code string, msg string, ctx *Context) *IssCurrentLocationError {
	return &IssCurrentLocationError{
		IsIssCurrentLocationError: true,
		Sdk:              "IssCurrentLocation",
		Code:             code,
		Msg:              msg,
		Ctx:              ctx,
	}
}

func (e *IssCurrentLocationError) Error() string {
	return e.Msg
}
