# IssCurrentLocation SDK utility: make_context

from projectname_sdk.core.context import IssCurrentLocationContext


def make_context_util(ctxmap, basectx):
    return IssCurrentLocationContext(ctxmap, basectx)
